use test;

UPDATE orders set description = "NC" where description = "SOD";

DELETE from orders where customer_code = "C00022" and description = "NC";