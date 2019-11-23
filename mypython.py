import pdfkit
import boto
import boto.s3
import sys
import datetime
import os

#option for pdf file
options = {
    'page-size': 'Letter',
    'margin-top': '0.25in',
    'margin-right': '0.25in',
    'margin-bottom': '0.25in',
    'margin-left': '0.25in'
}

#getting file_key and data from php file
html = sys.argv[1].decode('utf-8').strip()

name = sys.argv[2]

#makeing pdf file
pdfkit.from_string(html,'temp.pdf', options=options) 

#Insertion in s3 bucket start
from boto.s3.key import Key

#function to read data from file
def file_read(fname):
        with open (fname, "r") as myfile:
                data=myfile.readline()
		myfile.close()
		return data
               

#asseccing key and passcode for s3 bucket
key_id = file_read('access_codes/key.txt')
access_key = file_read('access_codes/pass.txt')


#assigning access_key and access_id triming data to avoid whiteSpace
AWS_ACCESS_KEY_ID =key_id.strip()
AWS_SECRET_ACCESS_KEY =access_key.strip()

#passing bucket name and connecting to s3
bucket_name = YOUR_BUCKET_NAME_HERE
conn = boto.connect_s3(AWS_ACCESS_KEY_ID,
        AWS_SECRET_ACCESS_KEY)


bucket = conn.create_bucket(bucket_name,
    location=boto.s3.connection.Location.DEFAULT)

#featch temp file for upload
tempfile = "./temp.pdf"

def percent_cb(complete, total):
    sys.stdout.write('.')
    sys.stdout.flush()


k = Key(bucket)

#assign key.name{came from php file}
k.key = name
k.set_contents_from_filename(tempfile,
    cb=percent_cb, num_cb=10)

