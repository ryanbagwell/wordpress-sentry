#!/bin/bash

read -p "Version:" version

echo $version

rm -rf /tmp/getsentry-client-svn
svn co http://plugins.svn.wordpress.org/getsentry-client/ /tmp/getsentry-client-svn

echo "Copying files to trunk"

git ls-tree -r --name-only HEAD | xargs -t -I file rsync -R file /tmp/getsentry-client-svn/trunk/

cd /tmp/getsentry-client-svn/

svn add trunk/*

svn status

svn commit -m "Version ${version}"

echo "Creating release tag"

mkdir /tmp/getsentry-client-svn/tags/${version}

svn add /tmp/getsentry-client-svn/tags/${version}

svn commit -m "Adding tag for Version ${version}"

echo "Copying versioned files to ${version} tag"

svn cp --parents trunk/* tags/${version}

svn commit -m "Tagging Version ${version}"










