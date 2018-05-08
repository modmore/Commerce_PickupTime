# PickupTime for Commerce

Stores the value of a "pickuptime" field in the shipping method step on an order and in the order shipments as tracking reference.

Requires Commerce 0.11 or higher.

## Configuration & Usage

You'll need to add a field with name "pickuptime" to your shipping template. Then the module stores the chosen pickup
time in the order properties (e.g. {{ order.properties.pickuptime }} will show it in most templates including emails),
and also into the tracking reference field of order shipments to make it visible in the order interface.


## Install as a package

A package is available in _packages on GitHub. 

## Building from source

To run the module from source, for example if you'd like to contribute a change, you'll need to take a few steps.

1. Clone the repository (or better yet, a clone of your own fork)

2. Copy config.core.sample.php to config.core.php, and if needed adjust it so that it includes your MODX site's config.core.php. Make sure you have [Commerce](https://www.modmore.com/commerce/) installed as well, of course.

3. From the browser open `_bootstrap/index.php`, this will set up the necessary settings and will make the module known to Commerce.

4. Enable the module under Configuration > Modules.
