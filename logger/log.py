import mysql.connector as mariadb
import datetime
import os
import sys
import psutil
import re
import io

def getCputemp():
        f = open("/sys/class/thermal/thermal_zone0/temp", "r")
        t = f.readline ()
        cputemp = "CPU temp: "+t
        tmp = re.search('(\d+)', cputemp).group(0)
        tmp = float(int(tmp)/1000.0)
        return tmp

def getCpuLoad():
        a = psutil.cpu_percent(interval=1, percpu=True)
        return a

def getDfDescription():
    df = os.popen("df -h /")
    i = 0
    while True:
        i = i + 1
        line = df.readline()
        if i==1:
            return(line.split()[0:6])
def getCurrentMemoryUsage():
        return psutil.virtual_memory().percent

def getDf():
    df = os.popen("df -h /")
    i = 0
    while True:
        i = i + 1
        line = df.readline()
        if i==2:
            return(line.split()[0:6])

mariadb_connection = mariadb.connect(user='monitoring_user', password='vkkz@QfvoU7Mh&Y3LhJSfi!Oakc6#h', database='monitoring')
cursor = mariadb_connection.cursor()

a = datetime.datetime.now()

description = getDfDescription()
disk_root = getDf()

cpu = getCpuLoad()
query = "INSERT INTO log ( storage, memory) VALUES ({}, {}, {}, {}, {}, {}, {})".
format(  re.search('(\d+)',disk_root[4]).group(0)$
cursor.execute(query)

mariadb_connection.commit()
b = datetime.datetime.now()
delta = b - a
print(int(delta.total_seconds() * 1000))


mariadb_connection.close()
