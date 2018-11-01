// blink.c
//
// Example program for bcm2835 library
// Blinks a pin on an off every 0.5 secs
//
// After installing bcm2835, you can build this
// with something like:
// gcc -o blink blink.c -l bcm2835
// sudo ./blink
//
// Or you can test it before installing with:
// gcc -o blink -I ../../src ../../src/bcm2835.c blink.c
// sudo ./blink
//
// Author: Mike McCauley
// Copyright (C) 2011 Mike McCauley
// $Id: RF22.h,v 1.21 2012/05/30 01:51:25 mikem Exp $

#include <bcm2835.h>
#include <stdio.h>
#include <string.h>

#define PIN1 RPI_V2_GPIO_P1_07 //GPIO4
#define PIN2 RPI_V2_GPIO_P1_15 //GPIO22
#define PIN3 RPI_V2_GPIO_P1_29 //GPIO5
#define PIN4 RPI_V2_GPIO_P1_37 //GPIO26

int main(int argc, char *argv[])
{
    // If you call this, it will not actually access the GPIO
    // Use for testing
//    bcm2835_set_debug(1);

	int res = bcm2835_init();
    if (res < 0){
      printf("bcm2835_init error = %d\n",res);
      return -1;
    }

    // Set the pin to be an output
    bcm2835_gpio_fsel(PIN1, BCM2835_GPIO_FSEL_OUTP);
    bcm2835_gpio_fsel(PIN2, BCM2835_GPIO_FSEL_OUTP);
    bcm2835_gpio_fsel(PIN3, BCM2835_GPIO_FSEL_OUTP);
    bcm2835_gpio_fsel(PIN4, BCM2835_GPIO_FSEL_OUTP);

    if (argc>1){
    	if (strcmp(argv[1],"turnon1")==0) {
    		bcm2835_gpio_write(PIN1, HIGH);
    	} else if (strcmp(argv[1],"turnoff1")==0){
    		bcm2835_gpio_write(PIN1, LOW);

    	} else if (strcmp(argv[1],"turnon2")==0) {
    		bcm2835_gpio_write(PIN2, HIGH);
    	} else if (strcmp(argv[1],"turnoff2")==0){
    		bcm2835_gpio_write(PIN2, LOW);

    	} else if (strcmp(argv[1],"turnon3")==0) {
    	    bcm2835_gpio_write(PIN3, HIGH);
       	} else if (strcmp(argv[1],"turnoff3")==0){
       		bcm2835_gpio_write(PIN3, LOW);

    	} else if (strcmp(argv[1],"turnon4")==0) {
        	bcm2835_gpio_write(PIN4, HIGH);
        } else if (strcmp(argv[1],"turnoff4")==0){
        	bcm2835_gpio_write(PIN4, LOW);

    	} else {
    		printf("Trying to run with wrong command = [%s]\n",argv[1]);
    		return -1;
    	}
    	printf("[%s] command sucessfully performed\n",argv[1]);

    } else {
    	printf("Function was called without args\n");
    	return -1;
    }
    /*
    // Blink
    while (1)
    {
	// Turn it on
	bcm2835_gpio_write(PIN, HIGH);

	// wait a bit
	bcm2835_delay(500);

	// turn it off
	bcm2835_gpio_write(PIN, LOW);

	// wait a bit
	bcm2835_delay(500);
    }
    bcm2835_close();
    */
    return 0;
}

