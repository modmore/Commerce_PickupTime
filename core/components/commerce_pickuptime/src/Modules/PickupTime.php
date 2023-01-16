<?php
namespace modmore\CommercePickupTime\Modules;
use modmore\Commerce\Events\Checkout;
use modmore\Commerce\Frontend\Steps\Shipping;
use modmore\Commerce\Modules\BaseModule;
use modmore\Commerce\Dispatcher\EventDispatcher;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class PickupTime extends BaseModule {

    public function getName()
    {
        $this->adapter->loadLexicon('commerce_pickuptime:default');
        return $this->adapter->lexicon('commerce_pickuptime');
    }

    public function getAuthor()
    {
        return 'Mark Hamstra';
    }

    public function getDescription()
    {
        return $this->adapter->lexicon('commerce_pickuptime.description');
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        // Load our lexicon
        $this->adapter->loadLexicon('commerce_pickuptime:default');

        $dispatcher->addListener(\Commerce::EVENT_CHECKOUT_BEFORE_STEP, [$this, 'checkForPickupTime']);
    }

    public function checkForPickupTime(Checkout $event)
    {
        $step = $event->getStep();
        if (!($step instanceof Shipping)) {
            return;
        }

        $pickupTime = $event->getDataKey('pickuptime');
        if (!empty($pickupTime)) {
            $order = $event->getOrder();

            if (class_exists('\modmore\Commerce\Order\Field\Text')) {
                $order->setOrderField(
                    new \modmore\Commerce\Order\Field\Text(
                        $this->commerce,
                        'pickuptime',
                        $pickupTime
                    )
                );
            }

            // @deprecated Use the Order Field instead
            $order->setProperty('pickuptime', $pickupTime);
            $order->save();

            foreach ($order->getShipments() as $shipment) {
                $shipment->set('tracking_reference', $this->adapter->lexicon('commerce_pickuptime.pickup_at', ['time' => $pickupTime]));
                $shipment->save();
            }
        }
    }
}
