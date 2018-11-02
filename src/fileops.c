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

/*
static long int lcl_checkFileSize(FILE *fp) {

	long int size = 0;
	// Moving pointer to end
	fseek(fp, 0, SEEK_END);
	size = ftell(fp);
	// Moving pointer back to start
	fseek(fp, 0, SEEK_SET);
	return size;
}
*/

FunctionResult saveGPIOstate(unsigned char GPIOstate){

	//FunctionResult fRes = FUNRES_NOK;
    FILE *fp;

    /*
    fp = open(GPIO_STATE_FILE_PATH, O_CREAT | O_WRONLY | O_EXCL, S_IRUSR | S_IWUSR);
    if (fp < 0) {
      // failure
      if (errno == EEXIST) {
        // the file already existed
        if (lcl_checkFileSize(fp) != GPIO_STATE_FILE_SIZE){
        	return FUNRES_NOK;
        }
      }
    } else {
      // now you can use the file
    }
    */

    fp = fopen(GPIO_STATE_FILE_PATH,"wb");
    if(fp == NULL){
    	return FUNRES_NOK;
    }
    fwrite(&GPIOstate,1,1,fp);
    fclose(fp);
    return FUNRES_OK;
}
