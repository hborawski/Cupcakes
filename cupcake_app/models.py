from django.db import models

# Create your models here.

class User(models.AbstractBaseUser):


class Item(models.Model):
	conditions = ["New out of box", "New in box", "Used in good condition","Used in fair condition", "Used in poor condition"]
	Name = models.CharField()
	Price = models.DecimalField(max_digits=10,decimal_places=2)
	Quantity = models.IntegerField(default=1)
	Condition = models.integerField(default=0)
	Description = models.CharField()
	ForSale = models.IntegerField(default=1)
	Available = models.IntegerField(default=1)

	def __unicode__(self):
		return self.Name + " " + self.Price + " " + condition[self.Condition]

class Notification(models.Model)
	Recipient = models.Charfield(max_length=15)
	Sender = models.CharField(max_length=15)
	Message = models.CharField()
	Time = model.DateTimeField()
	Read = models.IntegerField(default=0)

	def __unicode__(self):
		return self.Recipient + " " + self.Sender + " " + self.Message


