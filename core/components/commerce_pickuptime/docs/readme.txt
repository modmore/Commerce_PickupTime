PickupTime for Commerce
------------------------

Stores the customer-selected pickup time with the order and shipments.

You'll need to add a field with name "pickuptime" to your shipping template. Then the module stores the chosen pickup
time in the order properties (e.g. {{ order.properties.pickuptime }} will show it in most templates including emails),
and also into the tracking reference field of order shipments to make it visible in the order interface.
