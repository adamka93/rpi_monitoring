import mysql.connector as mariadb
import os

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

cursor.execute("SELECT disk FROM disk_usage ORDER BY id DESC LIMIT 1;")
result = cursor.fetchall() 

disk_root = getDf()[4][:-1]
if(abs(result[0][0] - int(disk_root)) >= 1):
	query = "INSERT INTO disk_usage (disk) VALUES ({})".format(disk_root)
	cursor.execute(query)

mariadb_connection.commit()

mariadb_connection.close()