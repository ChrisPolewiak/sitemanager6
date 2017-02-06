CREATE TABLE %prefix%_tinyerp_company (
  tinyerp_company__id CHAR(36) NOT NULL,
  tinyerp_company__name VARCHAR(255),
  tinyerp_company__city VARCHAR(255),
  tinyerp_company__street VARCHAR(255),
  tinyerp_company__postcode VARCHAR(32),
  tinyerp_company__postcity VARCHAR(255),
  tinyerp_company__country_id CHAR(36),
  tinyerp_company__vatcode VARCHAR(32),
  tinyerp_company__regon VARCHAR(32),
  tinyerp_company__email VARCHAR(255),
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_company__id),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE %prefix%_tinyerp_user (
  tinyerp_user__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  content_user__id char(36) NOT NULL,
  tinyerp_user__acl BLOB,
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_user__id),
  INDEX (content_user__id),
  UNIQUE (content_user__id),
  INDEX (tinyerp_company__id),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE %prefix%_tinyerp_invoicegroup (
  tinyerp_invoicegroup__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  tinyerp_invoicegroup__name VARCHAR(255),
  tinyerp_invoicegroup__prefix CHAR(6),
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_invoicegroup__id),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
CREATE TABLE %prefix%_tinyerp_invoice (
  tinyerp_invoice__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  tinyerp_invoicegroup__id CHAR(36) NOT NULL,
  tinyerp_customer__id char(36) NOT NULL,
  content_user__id CHAR(36),
  tinyerp_invoice__numberstr VARCHAR(255),
  tinyerp_invoice__numbercounter INT,
  tinyerp_invoice__date_issue DATE,
  tinyerp_invoice__date_delivery DATE,
  tinyerp_invoice__customer_name VARCHAR(255),
  tinyerp_invoice__customer_city VARCHAR(255),
  tinyerp_invoice__customer_street VARCHAR(32),
  tinyerp_invoice__customer_postcode VARCHAR(32),
  tinyerp_invoice__customer_postcity VARCHAR(255),
  tinyerp_invoice__customer_country VARCHAR(255),
  tinyerp_invoice__customer_vatcode VARCHAR(255),
  tinyerp_invoice__customer_email VARCHAR(255),
  tinyerp_invoice__payment_type CHAR(36),
  tinyerp_invoice__payment_date_limit DATE,
  tinyerp_invoice__payment_done FLOAT(10,2),
  tinyerp_user__id CHAR(36),
  tinyerp_invoice__issuername VARCHAR(255),
  tinyerp_invoice__receivername VARCHAR(255),
  tinyerp_bankaccount__id CHAR(36),
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_invoice__id),
  INDEX (tinyerp_customer__id),
  INDEX (tinyerp_invoice__numberstr),
  INDEX (tinyerp_invoice__date_issue),
  INDEX (content_user__id),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE %prefix%_tinyerp_invoiceline (
  tinyerp_invoiceline__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  tinyerp_invoice__id char(36) NOT NULL,
  tinyerp_product__id CHAR(36),
  tinyerp_invoiceline__number TINYINT,
  tinyerp_invoiceline__product_name VARCHAR(255),
  tinyerp_invoiceline__product_idx VARCHAR(255),
  tinyerp_invoiceline__quantity INT,
  tinyerp_invoiceline__unit VARCHAR(32),
  tinyerp_invoiceline__price_netto FLOAT(10,2),
  tinyerp_invoiceline__total_netto FLOAT(10,2),
  tinyerp_invoiceline__vat_code CHAR(36),
  tinyerp_invoiceline__vat_amount FLOAT(10,2),
  tinyerp_invoiceline__total_brutto FLOAT(10,2),
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_invoiceline__id),
  INDEX (tinyerp_invoice__id),
  INDEX (tinyerp_product__id),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE %prefix%_tinyerp_product (
  tinyerp_product__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  tinyerp_product__name VARCHAR(255),
  tinyerp_product__idx VARCHAR(255),
  tinyerp_product__unit VARCHAR(32),
  tinyerp_product__price_netto FLOAT(10,2),
  tinyerp_product__vat_code CHAR(2),
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_product__id),
  INDEX (tinyerp_product__name),
  INDEX (tinyerp_product__idx),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE %prefix%_tinyerp_customer (
  tinyerp_customer__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  tinyerp_customer__name VARCHAR(255),
  tinyerp_customer__city VARCHAR(255),
  tinyerp_customer__street VARCHAR(255),
  tinyerp_customer__postcode VARCHAR(32),
  tinyerp_customer__postcity VARCHAR(255),
  tinyerp_customer__country_id CHAR(36),
  tinyerp_customer__vatcode VARCHAR(32),
  tinyerp_customer__regon VARCHAR(32),
  tinyerp_customer__email VARCHAR(255),
  tinyerp_customer__payment_type TINYINT,
  tinyerp_customer__payment_days_limit INT,
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_customer__id),
  INDEX (tinyerp_customer__name),
  INDEX (tinyerp_customer__vatcode),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE %prefix%_tinyerp_bankaccount (
  tinyerp_bankaccount__id char(36) NOT NULL,
  tinyerp_company__id char(36) NOT NULL,
  tinyerp_bankaccount__name VARCHAR(255),
  tinyerp_bankaccount__number VARCHAR(255),
  record_create_date int(11) DEFAULT NULL,
  record_create_id char(36) NOT NULL,
  record_modify_date int(11) DEFAULT NULL,
  record_modify_id char(36) NOT NULL,
  PRIMARY KEY (tinyerp_bankaccount__id),
  INDEX (tinyerp_company__id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;