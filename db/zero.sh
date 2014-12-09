#!/bin/sh
# Deletes all threads and resets the counter.
# Please execute upon making changes to add_thread.php and/or
# add_answer.php. Execution assuming you're in the main folder:
#
#  $ cd db; ./zero.sh
#
# Author: Bruno02468

rm threads/*
echo 0 > counter
echo "All threads removed, counter has been reset."
