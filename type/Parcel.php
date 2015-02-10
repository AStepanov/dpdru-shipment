<?php

namespace stp\dpd\type;

use stp\dpd\BaseType;

/**
 * @property string $number *required* Номер посылки в информационной системе клиента (номер штрих-кода посылки)
 * @property int $weight  Вес посылки
 * @property int $length Длина посылки
 * @property int $width Ширина посылки
 * @property int $height Высота посылки
 * @property int $insuranceCost Стоимость посылки
 * @property int $insuranceCostVat НДС стоимости посылки
 * @property int $codAmount Сумма оплаты содержимого получателем
 */
class Parcel extends BaseType
{

}