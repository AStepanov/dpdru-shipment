<?php

namespace stp\dpd\type;

/**
 * Описание состояний посылок
 * @todo должен действительно возвращаться
 *
 * @property string $clientOrderNr Номер заказа в информационной системе клиента
 * @property string $clientParcelNr Номер посылки в информационной системе клиента
 * @property string $dpdOrderNr Номер заказа в информационной системе DPD
 * @property string $dpdParcelNr Номер посылки в информационной системе DPD
 * @property string $pickupDate	Дата приёма груза (2014-02-28)
 * @property string $dpdOrderReNr Номер повторного заказа в системе DPD (заполняется в том случае, если по одному и тому же клиентскому номеру посылки в системе DPD существует два заказа – например, при заказе на возврат посылки)
 * @property string $dpdParcelReNr Номер посылки при повторном заказе в системе DPD (заполняется в том случае, если по одному и тому же клиентскому номеру посылки в системе DPD существует два заказа – например, при заказе на возврат посылки)
 * @property string $planDeliveryDate Планируемая дата доставки посылки	(2014-03-01)
 * @property float $orderPhysicalWeight Физический вес (кг) отправки
 * @property float $orderVolume Объем (м3) отправки
 * @property float $orderVolumeWeight Объемный вес (кг.)отправки
 * @property float $orderPayWeight Платный вес  (кг.)
 * @property int $orderCost Объявленная ценность
 * @property float $parcelPhysicalWeight Физический вес (кг.)
 * @property float $parcelVolume Объем (м3)
 * @property float $parcelVolumeWeight Объемный вес (кг.) посылки
 * @property float $parcelPayWeight Платный вес (кг.) посылки
 * @property int $parcelLength Длина (см.) посылки
 * @property int $parcelWidth Ширина (см.) посылки
 * @property int $parcelHeight Высота (см.) посылки
 * @property string $newState Состояние посылки после перехода.
 * @property string $transitionTime Время перехода состояния (2012-04-04T17:10:15)
 * @property string $terminalCode Код терминала DPD, на котором произошел переход состояния
 * @property string $terminalCity Город терминала DPD, на котором произошел переход состояния
 * @property string $incidentCode Код инцидента, произошедшего при переходе состояния. Список возможных кодов инцидентов и их расшифровок вы можете получить у своего менеджера.
 * @property string $incidentName Наименование инцидента, произошедшего при переходе состояния
 * @property string $consignee|null Фактический получатель посылки (передается только со статусом Delivered)
 */
class ParcelState
{
    /**
     * оформлен новый заказ по инициативе клиента
     */
    const STATE_NEW_BY_CLIENT = 'NewOrderByClient';

    /**
     * оформлен новый заказ по инициативе DPD
     */
    const STATE_NEW_BY_DPD = 'NewOrderByDPD';
    /**
     * заказ отменен
     */
    const STATE_NOT_DONE = 'NotDone';
    /**
     * посылка находится на терминале приема отправления
     */
    const STATE_TERMINAL_PICKUP = 'OnTerminalPickup';
    /**
     * посылка находится в пути (внутренняя перевозка DPD)
     */
    const STATE_ON_ROAD = 'OnRoad';
    /**
     * посылка находится на транзитном терминале
     */
    const STATE_ON_TERMINAL = 'OnTerminal';
    /**
     * посылка находится на терминале доставки
     */
    const STATE_ON_TERMINAL_DELIVERY = 'OnTerminalDelivery';
    /**
     * посылка выведена на доставку
     */
    const STATE_DELIVERING = 'Delivering';
    /**
     * посылка доставлена получателю
     */
    const STATE_DELIVERED = 'Delivered';
    /**
     * посылка утеряна
     */
    const STATE_LOST = 'Lost';
    /**
     * с посылкой возникла проблемная ситуация
     */
    const STATE_PROBLEM = 'Problem';
    /**
     * посылка возвращена с доставки
     */
    const STATE_RETURNED_FROM_DELIVERY = 'ReturnedFromDelivery';

}
