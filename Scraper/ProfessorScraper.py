import re
import psycopg2
import WebScraperUtil


uni = 'https://unibz.it/en/'
academic_staff=[]

#regex to find the particulars for each professor
#+39, 1234 123456, name.surname@unibz.it, Monday, 00:00 - 00:00, BZ P0.00
regexes=['\+\d{2}','\d{4}\s?\d{6}','\w*?\.?\w*@unibz.it','\w*. \d{2}:\d{2} - \d{2}:\d{2}','BZ\sP\d\.\d{2}']

details=[re.compile(regex) for regex in regexes]


#regex to find the links to the teaching personel in the site
profile_url= re.compile('/person/.*')

#regex to find the links to the faculties in the site
faculties_to_visit=re.compile('faculties/\w*-?\w*/')




## collect the faculties of unibz

university_name,faculties = WebScraperUtil.get_list_of_urls(uni, faculties_to_visit, 'a','href',{'class':'nav_subLink nav_subLink-large'})

print(university_name)

#visit the academic-staff site of each faculty
for faculty in faculties:
   

    url=uni+faculty+'/academic-staff/'
    page_title,academic_staff= WebScraperUtil.get_list_of_urls(url,profile_url,'a','href')
 
    print(url)

#visit each professor's site

    for profile in academic_staff:
        person=[]
        professor=[]
        soup= WebScraperUtil.visitSite(uni+faculty+profile)
        
        #full name
        full_name= WebScraperUtil.getPageTitle(soup)
        full_name= full_name.split(' ')
        name = full_name[0]
        surname=''
        for word in full_name[1:]:
            surname += word+' '
       
        #name & surname
   
       
        person.append(name)
        person.append(surname)

        #contact details
        contact_info_block = (soup.find_all(class_="g g-4@md g-3@lg")) # parent element containing the contact info

        for index in range(0,5):
            contact_info = WebScraperUtil.filterlinks(regexes[index], contact_info_block) # we search for the specific information enconded in the patterns of contact_details list
          
            if index <= 2:
                
                if contact_info != []:

                    person.append(contact_info[0])
               
            
                else:
                    person.append(None)
            else: 
                if contact_info != []:
                    professor.append(contact_info[0])
                    print(contact_info[0])   
                else:
                    professor.append(None)
                
      
        #password
        person.append('0000')
        print(person)
        try:
            conn = psycopg2.connect(database="hbz", user = "postgres", password = "postgres", host = "localhost", port = "5432")
            cur = conn.cursor()


            cur.execute("INSERT INTO Users (id,name,surname,prefix,number,mail,password) VALUES (DEFAULT,%s,%s,%s,%s,%s,%s) RETURNING  id;",(person))
            id= cur.fetchone()
        
    
            cur.execute("INSERT INTO Professor VALUES (%s,%s,%s);",(id,professor[0],professor[1]))
            
            #courses taught
            text2= (soup.find_all(class_="u-h4 u-push-btm-2")) #parent element containing the text
            
            courses=[] 
            for course_element in text2:
            
                
                course=re.sub(r'[\r+\n+\t]', '',course_element.get_text()).strip()# we strip all the formatting and spaces
                
                print( course)
                courses.append(course) #create a set of courses 
            
            for course in courses:
            
                cur.execute("""SELECT id FROM Subject WHERE name = %s;""",[course])

                subjectId = cur.fetchone()
                if subjectId != None:
                  
                    cur.execute('INSERT INTO Teaches VALUES(%s,%s)',(id,subjectId)) #for each course we create and entry of the same professor
            
            conn.commit()      
        
        except (Exception, psycopg2.DatabaseError) as error: 
            print(error)
            conn.rollback()
            pass
      
cur.close()
if conn is not None:
    conn.close()
