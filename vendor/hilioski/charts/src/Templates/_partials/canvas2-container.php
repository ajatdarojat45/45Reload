<?php

$graph .= "
    <canvas id='$this->id' ";
    if (!$this->responsive) {
        $graph .= $this->height ? "height='$this->height' " : '';
        $graph .= $this->width ? "width='$this->width' " : '';
    }
$graph .= ' ></canvas>';
