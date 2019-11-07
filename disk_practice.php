<?php
$funcType = $_POST['funcType'];
$arr = $_POST['arr'];
$values = explode(" ",$arr);
//$values = array(20,22,40,12,45,42,50,16,30,24);
$que = array($values[1],$values[2],$values[3]);
$pointer = $values[0];
$len = count($values);
$total = 0;
$i = 0;


function findClosestInc($i,$arr) {
  $smol = 0;
  $currentSmallest = $i;
  foreach ($arr as $num) {
    if ($i < $num) {
      if ($currentSmallest > $num - $i) {
        $currentSmallest = $num - $i;
        $smol = $num;
      }
    }
  }
  return $smol;
}

function cScan($i,$len,$pointer,$que,$total,$values) {
  while ($i < $len) {
    $close = findClosestInc($pointer,$que);
    if ($close == 0) {
      $close = min($que);
      $quick = (100 - $pointer) + $close;
      $total = $total + $quick;
    } else {
      $total = ($close - $pointer) + $total;
    }

    $key = \array_search($close, $que);
    array_splice($que, $key, 1);

    if ($i == 0) {
      $nextInque = 4;
    } elseif ($nextInque == $len) {
        if (empty($que)) {
          echo "<p>Hypothetically elapsed seek time: ".$total."</p>";
          echo "<a href='disk_practice.html'>Go back</a>";
          break;
        }
    } else {
      $nextInque = $nextInque + 1;
    }
    if ($nextInque == $len) {
    } else {
      array_push($que, $values[$nextInque]);
    }
    $pointer = $close;
    $i = $i + 1;
  }
}

function scan($i,$len,$pointer,$que,$total,$values) {
  while ($i < $len) {
    $close = findClosestInc($pointer,$que);
    if ($close == 0) {
      $close = findClosest($pointer,$que);
    }
    if ($pointer > $close){
      $total = ($pointer - $close) + $total;
      } else {
      $total = ($close - $pointer) + $total;
      }

    $key = \array_search($close, $que);
    array_splice($que, $key, 1);

    if ($i == 0) {
      $nextInque = 4;
    } elseif ($nextInque == $len) {
        if (empty($que)) {
          echo "<p>Hypothetically elapsed seek time: ".$total."</p>";
          echo "<a href='disk_practice.html'>Go back</a>";
          break;
        }
    } else {
      $nextInque = $nextInque + 1;
    }
    if ($nextInque == $len) {
    } else {
      array_push($que, $values[$nextInque]);
    }
    $pointer = $close;
    $i = $i + 1;
  }
}

function findClosest($i,$arr){
  $smol = 0;
  foreach ($arr as $num) {
    if ($num == $arr[0]) {
      if ($i > $num) {
        $currentSmallest = $i - $num;
        $smol = $num;
      } else {
        $currentSmallest = $num - $i;
        $smol = $num;
      }
    } elseif ($i > $num) {
      if ($i - $num < $currentSmallest) {
        $currentSmallest = $i - $num;
        $smol = $num;
      }
    } else {
      if ($num - $i < $currentSmallest) {
        $currentSmallest = $num - $i;
        $smol = $num;
      }
    }
  }
  return $smol;
}

function sstf($i,$len,$pointer,$que,$total,$values) {
  while ($i < $len) {
    $close = findClosest($pointer, $que);
    if ($pointer > $close){
      $total = ($pointer - $close) + $total;
      } else {
      $total = ($close - $pointer) + $total;
      }

    $key = \array_search($close, $que);
    array_splice($que, $key, 1);

    if ($i == 0) {
      $nextInque = 4;
    } elseif ($nextInque == $len) {
        if (empty($que)) {
          echo "<p>Hypothetically elapsed seek time: ".$total."</p>";
          echo "<a href='disk_practice.html'>Go back</a>";
          break;
        }
    } else {
      $nextInque = $nextInque + 1;
    }
    if ($nextInque == $len) {
    } else {
      array_push($que, $values[$nextInque]);
    }
    $pointer = $close;
    $i = $i + 1;
  }
}


function fcfs($values,$len,$total,$i){
  while ($i < $len) {
    if ( $i == $len - 1 ) {
      echo "<p>Hypothetically elapsed seek time: ".$total."</p>";
      echo "<a href='disk_practice.html'>Go back</a>";
        break;
        } else {
          if ($values[$i]>$values[$i + 1]){
            $total = ($values[$i] - $values[$i + 1]) + $total;
          } else {
            $total = ($values[$i + 1] - $values[$i]) + $total;
          }
        }
    $i = $i + 1;
  }
}


if ($funcType == "fcfs") {
    fcfs($values,$len,$total,$i);
} elseif ($funcType == "sstf") {
    sstf($i,$len,$pointer,$que,$total,$values);
} elseif ($funcType == "scan") {
    scan($i,$len,$pointer,$que,$total,$values);
} elseif ($funcType == "cscan") {
    cScan($i,$len,$pointer,$que,$total,$values);
}

?>
