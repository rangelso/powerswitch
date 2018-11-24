/*
 * fileops.c
 *
 *  Created on: 1 lis 2018
 *      Author: tomasz
 */
#include <stdio.h>
#include <fcntl.h>
#include <errno.h>
#include "main.h"
#include "fileops.h"

FunctionResult loadGPIOstate(unsigned char *GPIOstate){

    FILE *fp;

    fp = fopen(GPIO_STATE_FILE_PATH,"rb");
    if(fp == NULL){
    	fclose(fp);
    	return FUNRES_NOK;
    }
    fread(GPIOstate,1,1,fp);
    fclose(fp);
    return FUNRES_OK;
}


FunctionResult saveGPIOstate(unsigned char GPIOstate){

	FILE *fp;

    fp = fopen(GPIO_STATE_FILE_PATH,"wb");
    if(fp == NULL){
    	fclose(fp);
    	return FUNRES_NOK;
    }

    fwrite(&GPIOstate,1,1,fp);
    fclose(fp);
    return FUNRES_OK;
}
