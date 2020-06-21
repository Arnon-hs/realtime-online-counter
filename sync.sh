#!/bin/sh

rsync --progress -rvht --delete-after root@194.67.78.176:/var/www/194-67-78-176.cloudvps.regruhosting.ru/* ./
rsync --progress -rvht --delete-after root@194.67.78.176:/var/www/194-67-78-176.cloudvps.regruhosting.ru/.[^.]* ./
#rsync --progress -rvht --delete-after root@194.67.78.176:/var/www/194-67-78-176.cloudvps.regruhosting.ru/.git/* ./.git/