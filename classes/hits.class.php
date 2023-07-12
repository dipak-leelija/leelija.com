<?php 
include_once("date.class.php"); 

/**
*	Show the relative statistics for hits depending uopn the duration.
*
*	@author		Himadri Shekhar Roy
*	@date		February 18, 2006
*	@version	1.0
*	@copyright	Analyze System
*	@url		http://www.ansysoft.com
*	@email		himadri.s.roy@ansysoft.com
* 
*/

class Hits  extends DateUtil
{
	use DBConnection;
	/**
	*	Add a count for the new hits on a particular date
	*
	*	@return NULL
	*/
	function addHit()
	{
		$date	= date("Y-m-d");
		$my		= date('mY');
		$sql 	= "INSERT INTO hits_counter(Count, added_on, month_year) VALUES (1, '$date','$my')";
		$query	= mysql_query($sql);
	}//eof
	
	/**
	*	Update a count for the new hits on a particular date
	*
	*	@return NULL
	*/
	function updHit()
	{
		$date	= date("Y-m-d");
		$sql 	= "UPDATE hits_counter SET
				   Count	= Count +1
				   WHERE 
				   added_on	=  '$date'";
		$query	= mysql_query($sql);
	}//eof
	
	/**
	*	Check if there is any hit on a particular date
	*
	*	@param
	*			$date	Particular date
	*
	*	@return int
	*/
	function getDayHit($date)
	{
		$count	= 0;
		
		$sel = "SELECT Count FROM hits_counter WHERE added_on	=  '$date'";
		$qry = mysql_query($sel);
		
		if(mysql_num_rows($qry) > 0)
		{
			$data = mysql_fetch_array($qry);
			$count = $data['Count'];
		}
		return $count;
	}//eof
	
	/**
	*	Check if there is any hit on a particular date
	*
	*	@param
	*			$date	Particular date
	*
	*	@return int
	*/
	function isHitExist($date)
	{
		$msg = '';
		$select = "SELECT * FROM hits_counter WHERE  added_on	=  '$date'";
		
		$query = mysql_query($select);
		//echo $select;exit;
		$num = mysql_num_rows($query);
		if($num >0)
		{
			$msg = 'FOUND';
		}
		else
		{
			$msg = 'NOT_FOUND';
		}
		return $msg;
	}//eof
	
	/**
	*	This function will add a hit or update a hit depending upon whether already data there or not.
	*
	*	@param
	*			$date	Particular date
	*
	*	@return NULL
	*/
	function updCounter()
	{
		$date	= date("Y-m-d");
		
		if (!session_is_registered("counted"))
		{
			$isHitted	= $this->isHitExist($date);
			if($isHitted == 'NOT_FOUND')
			{
				$this->addHit();
			}
			else
			{
				$this->updHit();
			}
			session_register("counted");
		}
		
	}//eof
	
	/**
	*	This function will add a hit or update a hit depending upon whether already data there or not.
	*
	*	@param
	*			$date	Particular date
	*
	*	@return NULL
	*/
	function updCounter2()
	{
		$date	= date("Y-m-d");
		
		/* if (!session_is_registered("counted"))
		{}*/
			$isHitted	= $this->isHitExist($date); 
			if($isHitted == 'NOT_FOUND')
			{
				$this->addHit();
			}
			else
			{
				$this->updHit();
			}
			//session_register("counted");
		
		
	}//eof
	
	/**
	*	Get total hits
	*	
	*	@return int
	*/
	function getTotalHits()
	{
		$num = 0;
		$select = "SELECT SUM(Count) AS TH FROM hits_counter";
		$query 	= mysql_query($select);
		
		//echo $select;exit;
		$res	= mysql_fetch_array($query);
		$num	= $res['TH'];
		
		return $num;
	}//eof
	
	/**
	*	Get last month hits
	*/
	function getLastMonthHits()
	{
		//get last month
		$thisMonth	=  (int)date("m");
		$thisYear	=  (int)date("Y");
		$lastMonth 	= 0;
		$lastYear	= 0;
		
		//if the month is january, shift by one year
		if($thisMonth == 1)
		{
			$lastMonth 	= 12;
			$lastYear	= $thisYear - 1;
		}
		else
		{
			$lastMonth 	= $thisMonth-1;
			$lastYear	= $thisYear;
		}
		
		if($lastMonth <10)
		{
			$lastMonth = '0'.$lastMonth;
		}
		
		//creating year month format
		$my	= $lastMonth.$lastYear;
		
		$num = 0;
		$select = "SELECT SUM(Count) AS TH FROM hits_counter WHERE month_year='$my'";
		$query 	= mysql_query($select);
		
		//echo $select;exit;
		$res	= mysql_fetch_array($query);
		$num	= $res['TH'];
		
		return $num;
		
	}//eof
	
	/**
	*	Get hits by month
	*/
	function getHitsByMonthYear($month, $year)
	{
		/*//get last month
		$thisMonth	=  (int)date("m");
		$thisYear	=  (int)date("Y");
		$lastMonth 	= 0;
		$lastYear	= 0;
		
		//if the month is january, shift by one year
		if($thisMonth == 1)
		{
			$lastMonth 	= 12;
			$lastYear	= $thisYear - 1;
		}
		else
		{
			$lastMonth 	= $thisMonth-1;
			$lastYear	= $thisYear;
		}
		
		if($lastMonth <10)
		{
			$lastMonth = '0'.$lastMonth;
		}*/
		
		//creating year month format
		if($month < 10)
		{
			$month	= "0".$month;
		}
		$my	= $month.$year;
		
		$num = 0;
		$select = "SELECT SUM(Count) AS TH FROM hits_counter WHERE month_year='$my'";
		$query 	= $this->conn->query($select);
		//echo $select.mysql_error();exit;
		//echo $select;exit;
		$res	= $query->fetch_array();
		$num	= $res['TH'];
		return $num;
		
	}//eof
	
}
?>