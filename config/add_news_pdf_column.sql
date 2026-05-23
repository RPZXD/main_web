-- config/add_news_pdf_column.sql
-- Add column for PDF attachments in news table

ALTER TABLE `news` ADD COLUMN `attachment_pdf` VARCHAR(255) NULL AFTER `image_url`;
