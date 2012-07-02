#! /bin/sh
#

# for a in *.pc *.h fat.c Makefile env.mk 
for a in *.php3 *.sql
do
	if [ ! -f RCS/$a,v ]
	then
		echo $a is out of source control! Its owner is `ls -l $a|cut -b 16-23`
	fi
done
#
#ls -l *.pc *.h fat.c Makefile env.mk|grep w

cd RCS
for a in `grep -c "locks; strict" *|grep :0|sed -e 's/,v.*/,v/'`
do
	printf  "%-8s  %s  %s\n" \
		"`grep strict $a|sed -e 's/^[^a-z]*//'|sed -e 's/:.*//'`" \
		"`ls -l $a|cut -b 42-53`" \
		"`echo $a|sed -e 's/,v//'`"
done
