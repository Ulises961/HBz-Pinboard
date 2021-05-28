
from bs4 import BeautifulSoup

from requests import get  # --it comes with get for requests
import re


## connects to the url passed and parses it with beautiful soup
def visitSite(url):
    response = get(url)
    return BeautifulSoup(response.content, 'html.parser')
    
## Returns the links belonging to the elements and class passed as arguments
def findlinks(soup,tag_name,tag_attribute='',attributes={}):

    tags =  soup.find_all(tag_name,attrs=attributes )
    if tag_attribute:
        tags=[tag[tag_attribute]for tag in tags]
    return tags


## filter the links that match the regex passed as argument and return a list of them
def filterlinks(regex,tags):
    found_Items=[]
    for element in tags:
        match=re.search(regex,str(element))
        if match:
            found_Items.append(match.group(0))
    return found_Items

## Takes away from the page title the /University of Bolzano name
def getPageTitle(soup):
    title_text = soup.title.get_text()
    #full name
    match= re.compile(',.*|./.*')
    full_name= match.sub('',title_text)

    return full_name

## combines visitsite findlinks and filterlinks methods returning only the matching urls 
def get_list_of_urls(url, regex, tag='', tag_attr='',options={}):
    soup= visitSite(url)
    link_tags= findlinks( soup,tag, tag_attr,options)
    matching_urls= filterlinks(regex,link_tags)
    faculty_name= getPageTitle(soup)
  
    return faculty_name,matching_urls

