import mysql.connector as mariadb
import psutil

def getCpuLoad():
    a = psutil.cpu_percent(interval=1, percpu=True)
    return a

mariadb_connection = mariadb.connect(user='monitoring_user', password='vkkz@QfvoU7Mh&Y3LhJSfi!Oakc6#h', database='monitoring')
cursor = mariadb_connection.cursor()

cursor.execute("SELECT cpu0,cpu1,cpu2,cpu3 FROM cpu_usage ORDER BY id DESC LIMIT 1;")
r = cursor.fetchall() 

limit = 1

cpu = getCpuLoad()
if(abs(r[0][0]-cpu[0])>limit or abs(r[0][1]-cpu[1])>limit or abs(r[0][2]-cpu[2])>limit or abs(r[0][3]-cpu[3])>limit):
	query = "INSERT INTO cpu_usage (cpu0, cpu1, cpu2, cpu3) VALUES ({},{},{},{})".format(cpu[0], cpu[1], cpu[2], cpu[3])
	cursor.execute(query)
	mariadb_connection.commit()

mariadb_connection.close()