#ifndef FILEOPS_H
#define FILEOPS_H

#include "main.h"

#define GPIO_STATE_FILE_PATH "gpiostate"
#define GPIO_STATE_FILE_SIZE (1)

FunctionResult saveGPIOstate(unsigned char GPIOstate);
FunctionResult loadGPIOstate(unsigned char *GPIOstate);

#endif
