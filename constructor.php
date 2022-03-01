<?php

class Class1 
{
    public array $numbers;

    public function __construct(array $numbers)
    {
      $this->numbers = $numbers;
    }	    


    public function bubbleSort()
    {
    	do
	{
	   $swapped = false;
	   
	   for( $i = 0, $c = count( $this->numbers ) - 1; $i < $c; $i++ )
	   {
		if( $this->numbers[$i] > $this->numbers[$i + 1] )
	          {
           	     list( $this->numbers[$i + 1], $this->numbers[$i] ) =
		     array( $this->numbers[$i], $this->numbers[$i + 1] );
		     $swapped = true;
		  }
	   }
	}
	while( $swapped );
	
	$highestValue = max($this->numbers);
	$countedValues = count($this->numbers);
	$middleValue = floor(($countedValues-1)/2);
	
	if ($countedValues % 2) {
          $median = $this->numbers[$middleValue];
        } else {
          $low = $this->numbers[$middleValue];
	  $high = $$this->numbers[$middleValue+1];
          $median = (($low+$high)/2);
	}

	return [$median, $highestValue];
    }	    
}


Class Class2 
{

	public function medianAndHighest()
	{
	  $class1 = (new Class1([42,38,5,19,27]))->bubbleSort();

          echo("median number: ". $class1[0] . "\n");
	  echo("highest number:". $class1[1]);

	  return;
	}

}


$class2 = (new Class2())->medianAndHighest();




?>
