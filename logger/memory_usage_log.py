import mysql.connector as mariadb
import psutil
import os

def getCurrentMemoryUsage():
        return psutil.virtual_memory().percent

mariadb_connection = mariadb.connect(user='monitoring_user', password='vkkz@QfvoU7Mh&Y3LhJSfi!Oakc6#h', database='monitoring')
cursor = mariadb_connection.cursor()

cursor.execute("SELECT memory FROM memory_usage ORDER BY id DESC LIMIT 1;")
result = cursor.fetchall() 

memory_usage = getCurrentMemoryUsage()
if(abs(result[0][0] - int(memory_usage)) >= 3):
	query = "INSERT INTO memory_usage (memory) VALUES ({})".format(memory_usage)
	cursor.execute(query)
	mariadb_connection.commit()

mariadb_connection.close()