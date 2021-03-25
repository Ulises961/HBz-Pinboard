
import re
import WebScraperUtil
import psycopg2





#### must set connection to db###
conn = psycopg2.connect(database="hbz", user = "postgres", password = "xxxx", host = "localhost", port = "5432")
cur = conn.cursor()




uni = 'https://unibz.it/'

#regex to find the links to the faculties in the site
faculties_to_visit=re.compile('/faculties/\w*-?\w*/')


special_subjects= re.compile('.*hesis.*|.*hoice.*|Optional.*|.*valuation.*|.*nternship.*| .*xam.*| Seminar.*')


## collect the faculties of unibz

page_name,faculties= WebScraperUtil.get_list_of_urls(uni,faculties_to_visit,'a','href',{'class':'nav_subLink nav_subLink-large'})

print(page_name)

#visit the academic-staff site of each faculty
for faculty in faculties:
    
    print(faculty)

    try:

        faculty_name, programs= WebScraperUtil.get_list_of_urls(uni+faculty,'.*','a','href',{'class':'blockLink'})


        cur.execute(""" INSERT INTO Faculty Values (DEFAULT,%s) RETURNING code;""",(faculty_name,))
        
        faculty_id = cur.fetchone()

        conn.commit()

        
    except (Exception, psycopg2.DatabaseError) as error: 
        print(error)
        conn.rollback()
       


    for program in programs:

        if  not program.__contains__("phd"):   

            soup= WebScraperUtil.visitSite(uni+program)
            print(program) # for debugging 
            program_name=WebScraperUtil.getPageTitle(soup)


            print(program_name)

            program_specs=soup.find(class_='typography typography-inverse typography-listAlt')
            
            if program_specs is not None: # some University program do not have duration

                lines=str(program_specs)
                lines=re.sub('<p>|<br/>|</p>|</div>','\n',lines)
                lines= lines.split('\n')
                
                print(lines) #for debugging

                
                program_name = program_name +'('+lines[1]+')' #eg Computer Science ( Bachelor in CS)
                
                program_duration = re.search('\d',lines[3]).group(0)
                program_duration= int(program_duration)
                program_tuple= ('',program_name,program_duration,'')

            
            try:
                cur.execute(""" INSERT INTO Program Values (DEFAULT,%s,%s,%s) RETURNING code;""",(program_name,program_duration,faculty_id,))

                program_id = cur.fetchone()

                conn.commit()
            except (Exception, psycopg2.DatabaseError) as error: 
                print(error)
                pass
                conn.rollback()
        


            study_plan_tags=WebScraperUtil.findlinks(soup,'a','href',{'class':'actionLink actionLink-theme'})
            
            studyplans=WebScraperUtil.filterlinks(re.compile('\/.*study-plan.*\/'),study_plan_tags)
        
            for study_plan in studyplans:

                soup= WebScraperUtil.visitSite(uni+study_plan)
                
                tags=soup.find_all(class_='g g-6@md g-4@lg g-6@print u-pbi-avoid u-push-btm-threeQuarter')
                    
                for tag in tags:
                    
                    

                    if tag.find_all(class_='u-push-top-2'): # then it has sub modules with a p tag for credits and b class for name of subject 
                        module_tags = tag.find_all(class_='u-push-top-2')
                        for module_tag in module_tags:    
                            
                            credit = re.sub(r'[\r+\n+\t+|\**]', '',module_tag.span.get_text()).strip()
                            credit= str.replace(credit,'CP', '')
                            subject = re.sub(r'[\r+\n+\t+]', '',module_tag.b.get_text()).strip()
                            subject += '('+tag.h4.get_text()+')'

                            result=(credit ,'\'' + subject + '\'')

                    else:    ## it is a regular class with p tag for credits and h4 tag for name of subject
                        
                        if not re.match(special_subjects, tag.h4.get_text()):

                            subject=re.sub(r'[\r+\n+\t+]', '',tag.h4.get_text()).strip()
                            credit= re.sub(r'[\r+\n+\t+\**]', '',tag.p.get_text()).strip()
                            
                            credit= str.replace(credit,'CP', '')
                        
                            if credit == '':
                                credit='0'


                            print(tag.h4.get_text()+' - '+credit)
                            
                    

                    try:
                        cur.execute(""" INSERT INTO Subject Values (DEFAULT,%s,%s) RETURNING id;""",(credit,subject,))
                        
                        subject_id= cur.fetchone()
                        
                        conn.commit()
                        
                        cur.execute(""" INSERT INTO Taught_In Values (%s,%s);""",(subject_id,program_id,))

                        conn.commit()
                        
                    except (Exception, psycopg2.DatabaseError) as error: 
                        print(error)
                        pass
                        conn.rollback()

cur.close()
if conn is not None:
    conn.close()
