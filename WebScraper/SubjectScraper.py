
from collections import UserList
from os import write
from typing import Literal, NoReturn, Text, Tuple
from bs4 import BeautifulSoup
from requests import get  # --it comes with get for requests
import re
import csv
import WebScraperUtil
import psycopg2

uni = 'https://unibz.it/'

#regex to find the links to the faculties in the site
faculties_to_visit=re.compile('/faculties/\w*-?\w*/')

i=0
subject_sql = open('Subjects.sql', 'a')
write = csv.writer(subject_sql)
faculty_sql= open('Faculty.sql','a')
writerF= csv.writer(faculty_sql)
program_sql= open('Program.sql','a')
writerP= csv.writer(program_sql)
## collect the faculties of unibz


faculties= WebScraperUtil.get_list_of_urls(uni,faculties_to_visit,'a','href',{'class':'nav_subLink nav_subLink-large'})

#visit the academic-staff site of each faculty
for faculty in faculties:
    
    
    print("level " + str(i))
    i+=1
    soup= WebScraperUtil.visitSite(uni+faculty)
    faculty_name= WebScraperUtil.getPageTitle(soup)

    writerF.writerow(('','\''+faculty_name+'\''))

    program_of_studies= WebScraperUtil.findlinks(soup,'a','href',{'class':'blockLink'})
  
 
    for program in program_of_studies:
            
        if not program.__contains__('phd'):
            print(program)
            soup= WebScraperUtil.visitSite(uni+program)
            program_name=WebScraperUtil.getPageTitle(soup)


            print(program_name)

            program_specs=soup.find(class_='typography typography-inverse typography-listAlt')
            if program_specs is not None:
                lines=str(program_specs)
                lines=re.sub('<p>|<br/>|</p>|</div>','\n',lines)
                lines= lines.split('\n')
                #print(lines)

                
                program_name = '\''+ program_name+'('+lines[1]+')\','
                
                program_duration = re.search('\d',lines[3]).group(0)
                
                program_tuple= ('',program_name,program_duration,'')
                writerP.writerow(program_tuple)
            
            study_plan_tags=WebScraperUtil.findlinks(soup,'a','href',{'class':'actionLink actionLink-theme'})
            
            studyplans=WebScraperUtil.filterlinks(re.compile('\/.*study-plan.*\/'),study_plan_tags)
        
            for study_plan in studyplans:

                soup= WebScraperUtil.visitSite(uni+study_plan)
                
                tags=soup.find_all(class_='g g-6@md g-4@lg g-6@print u-pbi-avoid u-push-btm-threeQuarter')
                             
                for tag in tags:
                    
                    tag = tag.extract()
                    if tag.find_all(class_='u-push-top-2'):
                        module_tags = tag.find_all(class_='u-push-top-2')
                        for module_tag in module_tags:    
                            
                            module_credits = re.sub(r'[\r+\n+\t+]', '',module_tag.span.get_text()).strip()
                            module_credits= str.replace(module_credits,'CP', '')
                            module_name = re.sub(r'[\r+\n+\t+]', '',module_tag.b.get_text()).strip()
                            module_name += '('+tag.h4.get_text()+')'

                            result=(module_credits ,'\'' + module_name + '\'')
                    else:
                        credit= re.sub(r'[\r+\n+\t+]', '',tag.p.get_text()).strip()
                        print(tag.h4.get_text()+' - '+credit)
                        credit= str.replace(credit,'CP', '')

                        subject=re.sub(r'[\r+\n+\t+]', '',tag.h4.get_text()).strip()
                        result=(credit , '\'' + subject+'\'')
                    write.writerow(result)

            subject_sql.flush
            program_sql.flush
faculty_sql.flush
subject_sql.close    
faculty_sql.close
program_sql.close


conn = psycopg2.connect(database="hbz", user = "postgres", password = "postgres", host = "10.42.0.1", port = "5432")

