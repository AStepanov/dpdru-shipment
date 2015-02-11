<?php

namespace stp\dpd\type;

use stp\dpd\BaseType;

/**
 * @property string $number Номер посылки в информационной системе клиента (номер штрих-кода посылки)
 * @property int|null $weight  Вес посылки
 * @property int|null $length Длина посылки
 * @property int|null $width Ширина посылки
 * @property int|null $height Высота посылки
 * @property int|null $insuranceCost Стоимость посылки
 * @property int|null $insuranceCostVat НДС стоимости посылки
 * @property int|null $codAmount Сумма оплаты содержимого получателем
 */
class Parcel extends BaseType
{

}