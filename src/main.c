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
#include "fileops.h"

#define PIN1 RPI_V2_GPIO_P1_07 //GPIO4
#define PIN2 RPI_V2_GPIO_P1_15 //GPIO22
#define PIN3 RPI_V2_GPIO_P1_29 //GPIO5
#define PIN4 RPI_V2_GPIO_P1_37 //GPIO26

#define PIN1_BIT (1)
#define PIN2_BIT (2)
#define PIN3_BIT (3)
#define PIN4_BIT (4)

static void lcl_setBit(unsigned char *byte, int bit){
	(*byte) |= (1 << (bit-1));
}

static void lcl_clearBit(unsigned char *byte, int bit){
	(*byte) &= ~(1 << (bit-1));
}

int main(int argc, char *argv[]) {
	// If you call this, it will not actually access the GPIO
	// Use for testing
//    bcm2835_set_debug(1);

	unsigned char GPIOstate = 0;
	unsigned char firstSave = 0;
	unsigned char loadingError = 0;

	if (argc <= 1) {
		printf("Function was called without args\n");
		return -1;
	}

	int res = bcm2835_init();

	if (res < 0) {
		printf("bcm2835_init error = %d\n", res);
		return -1;
	}

	// Set the pin to be an output
	bcm2835_gpio_fsel(PIN1, BCM2835_GPIO_FSEL_OUTP);
	bcm2835_gpio_fsel(PIN2, BCM2835_GPIO_FSEL_OUTP);
	bcm2835_gpio_fsel(PIN3, BCM2835_GPIO_FSEL_OUTP);
	bcm2835_gpio_fsel(PIN4, BCM2835_GPIO_FSEL_OUTP);

	if (loadGPIOstate(&GPIOstate) == FUNRES_NOK) {
		loadingError = 1;
	}

	//channel 1
	if (strcmp(argv[1], "turnon1") == 0) {
		bcm2835_gpio_write(PIN1, HIGH);
		lcl_setBit(&GPIOstate, PIN1_BIT);

	} else if (strcmp(argv[1], "turnoff1") == 0) {
		bcm2835_gpio_write(PIN1, LOW);
		lcl_clearBit(&GPIOstate, PIN1_BIT);

		//channel 2
	} else if (strcmp(argv[1], "turnon2") == 0) {
		bcm2835_gpio_write(PIN2, HIGH);
		lcl_setBit(&GPIOstate, PIN2_BIT);

	} else if (strcmp(argv[1], "turnoff2") == 0) {
		bcm2835_gpio_write(PIN2, LOW);
		lcl_clearBit(&GPIOstate, PIN2_BIT);

		//channel 3
	} else if (strcmp(argv[1], "turnon3") == 0) {
		bcm2835_gpio_write(PIN3, HIGH);
		lcl_setBit(&GPIOstate, PIN3_BIT);

	} else if (strcmp(argv[1], "turnoff3") == 0) {
		bcm2835_gpio_write(PIN3, LOW);
		lcl_clearBit(&GPIOstate, PIN3_BIT);

		//channel 4
	} else if (strcmp(argv[1], "turnon4") == 0) {
		bcm2835_gpio_write(PIN4, HIGH);
		lcl_setBit(&GPIOstate, PIN4_BIT);

	} else if (strcmp(argv[1], "turnoff4") == 0) {
		bcm2835_gpio_write(PIN4, LOW);
		lcl_clearBit(&GPIOstate, PIN4_BIT);

		//channel 1-4
	} else if (strcmp(argv[1], "turnonall") == 0) {
		bcm2835_gpio_write(PIN1, HIGH);
		bcm2835_gpio_write(PIN2, HIGH);
		bcm2835_gpio_write(PIN3, HIGH);
		bcm2835_gpio_write(PIN4, HIGH);
		lcl_setBit(&GPIOstate, PIN1_BIT);
		lcl_setBit(&GPIOstate, PIN2_BIT);
		lcl_setBit(&GPIOstate, PIN3_BIT);
		lcl_setBit(&GPIOstate, PIN4_BIT);

	} else if (strcmp(argv[1], "turnoffall") == 0) {
		bcm2835_gpio_write(PIN1, LOW);
		bcm2835_gpio_write(PIN2, LOW);
		bcm2835_gpio_write(PIN3, LOW);
		bcm2835_gpio_write(PIN4, LOW);
		lcl_clearBit(&GPIOstate, PIN1_BIT);
		lcl_clearBit(&GPIOstate, PIN2_BIT);
		lcl_clearBit(&GPIOstate, PIN3_BIT);
		lcl_clearBit(&GPIOstate, PIN4_BIT);

		//start sequence
	} else if (strcmp(argv[1], "start") == 0) {
		bcm2835_delay(5000);
		bcm2835_gpio_write(PIN1, HIGH);
		bcm2835_gpio_write(PIN2, HIGH);
		bcm2835_gpio_write(PIN3, HIGH);
		bcm2835_gpio_write(PIN4, HIGH);
		lcl_setBit(&GPIOstate, PIN1_BIT);
		lcl_setBit(&GPIOstate, PIN2_BIT);
		lcl_setBit(&GPIOstate, PIN3_BIT);
		lcl_setBit(&GPIOstate, PIN4_BIT);
		firstSave = 1;

	} else {
		printf("Trying to run with wrong command = [%s]\n", argv[1]);
		return -1;
	}

	if (!firstSave && loadingError) {
		printf("Loading GPIO state failed");
		return -1;
	}

	if (saveGPIOstate(GPIOstate) == FUNRES_NOK) {
		printf("Saving GPIO state failed");
		return -1;
	}

	printf("[%s] command sucessfully performed\n", argv[1]);

	/*
	 // wait a bit
	 bcm2835_delay(500);
	 }
	 */

	bcm2835_close();

	return 0;
}

