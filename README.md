update--
- added custom autonumeric, bantana.js
- add kas group menu
    --create view 
    -- bantana.kasgroup source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `bantana`.`kasgroup` AS
select
    sum(`x`.`total`) AS `total`,
    `x`.`nama` AS `type`,
    `x`.`jenis` AS `jenis`,
    `x`.`fakturPenjualan` AS `fakturPenjualan`,
    `x`.`tanggal` AS `tanggal`
from
    (
    select
        `b`.`jenis` AS `jenis`,
        `r`.`nama` AS `nama`,
        sum(`d`.`subtotal`) AS `total`,
        `s`.`fakturPenjualan` AS `fakturPenjualan`,
        `s`.`tanggal` AS `tanggal`
    from
        (((`bantana`.`service` `s`
    join `bantana`.`detail_service` `d` on
        ((`d`.`idService` = `s`.`id`)))
    join `bantana`.`barang` `b` on
        ((`b`.`id` = `d`.`idBarang`)))
    join `bantana`.`referensi` `r` on
        ((`r`.`id` = `b`.`jenis`)))
    group by
        `b`.`jenis`,
        `s`.`fakturPenjualan`,
        `s`.`tanggal`) `x`
group by
    `x`.`fakturPenjualan`,
    `x`.`tanggal`,
    `x`.`jenis`
order by
    `x`.`tanggal`,
    `x`.`fakturPenjualan`;
- add stok barang yg akan habis
- add dashboard
- revisi minimstok (add seting param=minimstok)