#!/bin/bash

##########################################################################################################
# SCRIPT
##########################################################################################################

source ./update_thumbs.conf
source ./update_thumbs.func

read -s -p "Password:" FTP_PASSWD
echo


echo
echo Starting in 5 seconds...
sleep 5


echo
echo Running...

while :
do
    rm -rf "$LOCAL_TMP"
    mkdir "$LOCAL_TMP"

    curl -s $JSON_URL | ./JSON.sh | grep -P '\[\d+\]' | sed 's,\\,,g' | while read i
    do
        id=$(echo $i | sed 's/.*"id":\(.*\),".*/\1/g')
        url=$(echo $i | sed 's/.*"url":"\(.*\)"}.*/\1/g')
        
        echo id="$id", url="$url"
        
        cp thumb-unavailable.jpg $LOCAL_TMP/$id-thumb.jpg
        
        timeout $FETCH_TIMEOUT_SECS phantomjs --ignore-ssl-errors=yes capture.js $url $LOCAL_TMP/$id.png 
        
        convert -extract 1280x720+0+0 -interlace line -background white -flatten -thumbnail 160x90! $LOCAL_TMP/$id.png $LOCAL_TMP/$id-thumb.jpg

        rm $LOCAL_TMP/$id.png

        if [ -z "$(ls -A $LOCAL_TMP)" ]
        then
            echo 'No upload required!'
        else
            ftp_upload $FTP_HOST $FTP_USER $FTP_PASSWD "$LOCAL_TMP" "$FTP_TARGET_DIR"
        fi
        
        rm $LOCAL_TMP/*

        echo ---
    done

    rm -rf "$LOCAL_TMP"

    sleep $FETCH_PAUSE_SECS
done
