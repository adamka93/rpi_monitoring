import mysql.connector as mariadb
import re

def getCputemp():
        f = open("/sys/class/thermal/thermal_zone0/temp", "r")
        t = f.readline ()
        cputemp = "CPU temp: "+t
        tmp = re.search('(\d+)', cputemp).group(0)
        tmp = float(int(tmp)/1000.0)
        return tmp

mariadb_connection = mariadb.connect(user='monitoring_user', password='vkkz@QfvoU7Mh&Y3LhJSfi!Oakc6#h', database='monitoring')
cursor = mariadb_connection.cursor()

cursor.execute("SELECT temp FROM cpu_temp ORDER BY id DESC LIMIT 1;")
result = cursor.fetchall() 

cputemp = getCputemp()
if(abs(result[0][0] - cputemp) >= 1):
	query = "INSERT INTO cpu_temp (temp) VALUES ({})".format(cputemp)
	cursor.execute(query)

mariadb_connection.commit()

mariadb_connection.close()