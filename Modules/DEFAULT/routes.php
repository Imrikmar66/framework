<?php

// For GET request, url default, execute DefaultController->abs(), uses default as the route alias
R::addRoute('GET', 'default', 'Default::abs')->as('default');