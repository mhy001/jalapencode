#!/bin/bash

kill -15 $(ps -ef | grep -v grep | grep -i php | awk '{print $2}')
brew services stop mysql
