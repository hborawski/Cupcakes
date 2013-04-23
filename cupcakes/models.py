from django.db import models

# Create your models here.

class User(models.Model):
	Email = models.CharField(max_length=15)
	Password = models.CharField(max_length=255)
	Time = models.DateTimeField('date created')
	Permission = models.IntegerField(default=0)
	Location = models.IntegerField(default=0)
	Salt = models.CharField(max_length=16)

class Item(models.Model):
	Name = models.CharField()
	Price = models.DecimalField(max_digits=10,decimal_places=2)
	Quantity = models.IntegerField(default=1)
	Condition = models.integerField(default=0)
	Description = models.CharField()
	ForSale = models.IntegerField(default=1)
	Available = models.IntegerField(default=1)

	def __unicode__(self):
		return self.Name + " " + self.Price

class Notification(models.Model)
	Recipient = models.Charfield(max_length=15)
	Sender = models.CharField(max_length=15)
	Message = models.CharField()
	Time = model.DateTimeField()
	Read = models.IntegerField(default=0)
	def __unicode__(self):
		return self.Recipient + " " + self.Sender


