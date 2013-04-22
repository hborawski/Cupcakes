from django.db import models

# Create your models here.

class User(models.Model):
	Email = models.CharField(max_length=15)
	Password = models.CharField(max_length = 255)
	Time = models.DateTimeField('date created')
	Permission = models.IntegerField(default=0)
	Location = models.IntegerField(default=0)
	Salt = models.CharField(max_length=16)



