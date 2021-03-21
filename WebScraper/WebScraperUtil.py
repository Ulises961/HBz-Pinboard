from collections import UserList
from os import write
from typing import Text
from bs4 import BeautifulSoup
from bs4.element import ResultSet
from requests import get  # --it comes with get for requests
import re
import csv


def visitSite(url):
    response = get(url)
    return BeautifulSoup(response.content, 'html.parser')
    
def findlinks(soup,tag_name,tag_attribute='',attributes={}):

    tags = [tag for tag in soup.find_all(tag_name,attrs=attributes )]
    if tag_attribute:
        tags=[tag[tag_attribute]for tag in tags]
    return tags
    
def filterlinks(regex,tags):
    found_Items=[]
    for element in tags:
        match=re.search(regex,str(element))
        if match:
            found_Items.append(match.group(0))
    return found_Items
    
def getPageTitle(soup):
    title_text = soup.title.get_text()
    #full name
    match= re.compile(',.*|./.*')
    full_name= match.sub('',title_text)

    return full_name

def get_list_of_urls(url, regex, tag='', tag_attr='',options={}):
    soup= visitSite(url)
    link_tags= findlinks( soup,tag, tag_attr,options)
    matching_urls= filterlinks(regex,link_tags)
  
    return matching_urls

def getFacultyPrograms(base_url,faculty):

    soup= visitSite(base_url+faculty)
    faculty_name= getPageTitle(soup)
    program_of_studies= findlinks(soup,'a','href',{'class':'blockLink'})
    return  faculty.Faculty(faculty_name,program_of_studies)

