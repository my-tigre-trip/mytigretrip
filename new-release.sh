#! /bin/sh
# compress mytigretrip and wp-content/themes/gotravel-child folders and store them in the releases folder
days=$(date +%Y%m%d_%H%M)
mtt="mytigretrip-${days}.tar"
gotravel_child="gotravel-child-${days}.tar"
cwd=$(pwd)
releases=${cwd}/releases

echo "working in ${cwd}"
#tar cvzf ./releases/{mtt} mytigretrip
cd mytigretrip && tar -cvf ${releases}/${mtt} . && cd ${cwd}
echo "mytigretrip folder packed and saved in ${releases}/${mtt}"

#remove app cache??
echo "-----"
echo "working in ${cwd}"
cd wp-content/themes/gotravel-child && tar -cvf ${releases}/${gotravel_child} . && cd ${cwd}
#tar cvzf ./releases/gotravel-child-${gotravel-child}.tar.gz wp-content/themes/gotravel-child
echo "gotravel-child folder packed and saved in ${releases}/${gotravel_child}"

#upload to siteground
echo "uploading to staging releases folder"
scp -P 18765  ./releases/${mtt} tigrepri@mytigretrip.com:public_html/staging/mtt-updates
scp -P 18765  ./releases/${gotravel_child} tigrepri@mytigretrip.com:public_html/staging/mtt-updates

#
#upload to staging destination folders
# improve avoid uloading twice
echo "uploading to staging folders"
scp -P 18765  ./releases/${mtt} tigrepri@mytigretrip.com:public_html/staging/mytigretrip
scp -P 18765  ./releases/${gotravel_child} tigrepri@mytigretrip.com:public_html/staging/wp-content/themes/gotravel-child