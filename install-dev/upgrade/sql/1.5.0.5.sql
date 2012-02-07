SET NAMES 'utf8';

ALTER TABLE `PREFIX_cart_rule` ADD `shop_restriction` tinyint(1) unsigned NOT NULL default 0 AFTER `product_restriction`;

CREATE TABLE `PREFIX_cart_rule_shop` (
	`id_cart_rule` int(10) unsigned NOT NULL,
	`id_shop` int(10) unsigned NOT NULL,
	PRIMARY KEY  (`id_cart_rule`, `id_shop`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8;

INSERT INTO `PREFIX_configuration`(`id_group_shop`, `id_shop`, `name`, `value`, `date_add`, `date_upd`)
VALUES
	(NULL, NULL, 'PS_LOGO', 'logo.jpg', NOw(), NOW())
	(NULL, NULL, 'PS_LOGO_MAIL', 'logo_mail.jpg', NOw(), NOW())
	(NULL, NULL, 'PS_LOGO_INVOICE', 'logo_invoice.jpg', NOw(), NOW());
