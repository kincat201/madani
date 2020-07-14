ALTER TABLE `products`
	CHANGE COLUMN `qty` `qty` DOUBLE NULL DEFAULT NULL AFTER `image`;
ALTER TABLE `product_stocks`
	CHANGE COLUMN `qty_before` `qty_before` DOUBLE NULL DEFAULT NULL AFTER `types`,
	CHANGE COLUMN `qty_after` `qty_after` DOUBLE NULL DEFAULT NULL AFTER `qty_before`;
ALTER TABLE `orders`
	ADD COLUMN `tmp_name` VARCHAR(255) NULL DEFAULT NULL AFTER `member_id`,
	ADD COLUMN `designer_id` INT(11) NULL DEFAULT 0 AFTER `deleted`,
	ADD COLUMN `cashier_id` INT(11) NULL DEFAULT 0 AFTER `designer_id`,
	ADD COLUMN `operator_id` INT(11) NULL DEFAULT 0 AFTER `cashier_id`;
ALTER TABLE `orders`
	ADD COLUMN `created_by` INT(11) NULL DEFAULT 0 AFTER `operator_id`;
ALTER TABLE `orders`
	ADD COLUMN `file_design` VARCHAR(255) NULL DEFAULT NULL AFTER `is_design`;

