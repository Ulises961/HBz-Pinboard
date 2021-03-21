from collections import UserList
from os import write
from typing import Mapping, Text
from bs4 import BeautifulSoup
from requests import get  # --it comes with get for requests
import re
import csv
import WebScraperUtil



uni = 'https://unibz.it/en/'
academic_staff=[]

#regex to find the particulars for each professor
#+39, 1234 123456, name.surname@unibz.it, Monday, 00:00 - 00:00, BZ P0.00
regexes=['\+\d{2}','\d{4}\s\d{6}','\w*?\.?\w*@unibz.it','\w*. \d{2}:\d{2} - \d{2}:\d{2}','BZ\bP\d\.\d{2}']

details=[re.compile(regex) for regex in regexes]


#regex to find the links to the teaching personel in the site
profile_url= re.compile('/person/.*')

#regex to find the links to the faculties in the site
faculties_to_visit=re.compile('faculties/\w*-?\w*/')

i=0

file = open('Professors.sql', 'a')
write = csv.writer(file)


## collect the faculties of unibz

faculties = WebScraperUtil.get_list_of_urls(uni, faculties_to_visit, 'a','href',{'class':'nav_subLink nav_subLink-large'})


#visit the academic-staff site of each faculty
for faculty in faculties:
   
 #   print("level " + str(i))
   # i+=1
    url=uni+faculty+'/academic-staff/'
    academic_staff= WebScraperUtil.get_list_of_urls(url,profile_url,'a','href')
 
  #  print(faculty)

#visit each professor's site

    for profile in academic_staff:
        person=[]
        professor=[]
        soup= WebScraperUtil.visitSite(uni+faculty+profile)
        
        #full name
        full_name= WebScraperUtil.getPageTitle(soup)
        full_name= full_name.split(' ')
 
        
        #name & surname

        for name in full_name:
            person.append(name)

        #contact details
        contact_info_block = (soup.find_all(class_="g g-4@md g-3@lg")) # parent element containing the contact info

        for index in range(0,4):
            contact_info = WebScraperUtil.filterlinks(regexes[index], contact_info_block) # we search for the specific information enconded in the patterns of contact_details list
            
            if index < 3:
                if contact_info != []:

                    person.append(contact_info[0])
               
            
                else:
                    person.append(None)
            else: 
                if contact_info != []:
                    professor.append(contact_info[0])   
                else:
                    professor.append(None)
        
        # professor += ')'

        #blank space for password
        person.append('0000')
        print(person)

        #courses taught
        text2= (soup.find_all(class_="u-h4 u-push-btm-2")) #parent element containing the text
        
        courses=[] 
        for course_element in text2:
        
               
            course=re.sub(r'[\r+\n+\t]', '',course_element.get_text()).strip()# we strip all the formatting and spaces
            
    #          print( course)
            courses.append(course) #create a set of courses 
            
        
        professor=[person+courses] #for each course we create and entry of the same professor
        write.writerow(professor)
        file.flush
   #     print(professor)
        
file.close    
