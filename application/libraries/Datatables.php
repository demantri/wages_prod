<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

  class Datatables
  {
   
    protected $ci;
    protected $table;
    protected $select         = array();
    protected $joins          = array();
    protected $columns        = array();
    protected $where          = array();
    protected $filter         = array();
    protected $add_columns    = array();
    protected $edit_columns   = array();
    protected $unset_columns  = array();
   
    public function __construct()
    {
      $this->ci =& get_instance();
    }
   
    public function select($columns, $backtick_protect = TRUE)
    {
      foreach($this->explode(',', $columns) as $val)
      {
        $column = trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$2', $val)); 
        $this->columns[] =  $column;
        $this->select[$column] =  trim(preg_replace('/(.*)\s+as\s+(\w*)/i', '$1', $val));
      }
      $this->ci->db->select($columns, $backtick_protect);
      return $this;
    }
    
    public function from($table)
    {
      $this->table = $table;
      $this->ci->db->from($table);
      return $this;
    }
   
    public function join($table, $fk, $type = NULL)
    {
      $this->joins[] = array($table, $fk, $type);
      $this->ci->db->join($table, $fk, $type);
      return $this;
    }
   
    public function where($key_condition, $val = NULL, $backtick_protect = TRUE)
    {
      $this->where[] = array($key_condition, $val, $backtick_protect);
      $this->ci->db->where($key_condition, $val, $backtick_protect);
      return $this;
    }
    
    public function filter($key_condition, $val = NULL, $backtick_protect = TRUE)
    {
      $this->filter[] = array($key_condition, $val, $backtick_protect);
      return $this;
    }
  
    public function add_column($column, $content, $match_replacement = NULL)
    {
      $this->add_columns[$column] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
      return $this;
    }
    
    public function edit_column($column, $content, $match_replacement)
    {
      $this->edit_columns[$column][] = array('content' => $content, 'replacement' => $this->explode(',', $match_replacement));
      return $this;
    }
    
    public function unset_column($column)
    {
      $this->unset_columns[] = $column;
      return $this;
    }
   
    public function generate($charset = 'UTF-8')
    {
      $this->get_paging();
      $this->get_ordering();
      $this->get_filtering();
      return $this->produce_output($charset);
    }
   
    protected function get_paging()
    {
      $iStart = $this->ci->input->post('iDisplayStart');
      $iLength = $this->ci->input->post('iDisplayLength');
      $this->ci->db->limit(($iLength != '' && $iLength != '-1')? $iLength : 10, ($iStart)? $iStart : 0);
    }
   
    protected function get_ordering()
    {
      if ($this->check_mDataprop())
        $mColArray = $this->get_mDataprop();
      elseif ($this->ci->input->post('sColumns'))
        $mColArray = explode(',', $this->ci->input->post('sColumns'));
      else
        $mColArray = $this->columns;
      $mColArray = array_values(array_diff($mColArray, $this->unset_columns));
      $columns = array_values(array_diff($this->columns, $this->unset_columns));
      for($i = 0; $i < intval($this->ci->input->post('iSortingCols')); $i++)
        if(isset($mColArray[intval($this->ci->input->post('iSortCol_' . $i))]) && in_array($mColArray[intval($this->ci->input->post('iSortCol_' . $i))], $columns) && $this->ci->input->post('bSortable_'.intval($this->ci->input->post('iSortCol_' . $i))) == 'true')
          $this->ci->db->order_by($mColArray[intval($this->ci->input->post('iSortCol_' . $i))], $this->ci->input->post('sSortDir_' . $i));
    }
    
    protected function get_filtering()
    {
      if ($this->check_mDataprop())
        $mColArray = $this->get_mDataprop();
      elseif ($this->ci->input->post('sColumns'))
        $mColArray = explode(',', $this->ci->input->post('sColumns'));
      else
        $mColArray = $this->columns;
      $sWhere = '';
      $sSearch = $this->ci->db->escape($this->ci->input->post('sSearch'));
      $mColArray = array_values(array_diff($mColArray, $this->unset_columns));
      $columns = array_values(array_diff($this->columns, $this->unset_columns));
      if($sSearch != '')
        for($i = 0; $i < count($mColArray); $i++)
          if($this->ci->input->post('bSearchable_' . $i) == 'true' && in_array($mColArray[$i], $columns))
            $sWhere .= $this->select[$mColArray[$i]] . " LIKE '%" . $sSearch . "%' OR ";
      $sWhere = substr_replace($sWhere, '', -3);
      if($sWhere != '')
        $this->ci->db->where('(' . $sWhere . ')');
      for($i = 0; $i < intval($this->ci->input->post('iColumns')); $i++)
      {
        if(isset($_POST['sSearch_' . $i]) && $this->ci->input->post('sSearch_' . $i) != '' && in_array($mColArray[$i], $columns))
        {
          $miSearch = explode(',', $this->ci->input->post('sSearch_' . $i));
          foreach($miSearch as $val)
          {
            if(preg_match("/(<=|>=|=|<|>)(\s*)(.+)/i", trim($val), $matches))
              $this->ci->db->where($this->select[$mColArray[$i]].' '.$matches[1], $matches[3]);
            else
              $this->ci->db->where($this->select[$mColArray[$i]].' LIKE', '%'.$val.'%');
          }
        }
      }
      foreach($this->filter as $val)
        $this->ci->db->where($val[0], $val[1], $val[2]);
    }
   
    protected function get_display_result()
    {
      return $this->ci->db->get();
    }
   
    protected function produce_output($charset)
    {
      $aaData = array();
      $rResult = $this->get_display_result();
      $iTotal = $this->get_total_results();
      $iFilteredTotal = $this->get_total_results(TRUE);
      foreach($rResult->result_array() as $row_key => $row_val)
      {
        $aaData[$row_key] = ($this->check_mDataprop())? $row_val : array_values($row_val);
        foreach($this->add_columns as $field => $val)
          if($this->check_mDataprop())
            $aaData[$row_key][$field] = $this->exec_replace($val, $aaData[$row_key]);
          else
            $aaData[$row_key][] = $this->exec_replace($val, $aaData[$row_key]);
        foreach($this->edit_columns as $modkey => $modval)
          foreach($modval as $val)
            $aaData[$row_key][($this->check_mDataprop())? $modkey : array_search($modkey, $this->columns)] = $this->exec_replace($val, $aaData[$row_key]);
        $aaData[$row_key] = array_diff_key($aaData[$row_key], ($this->check_mDataprop())? $this->unset_columns : array_intersect($this->columns, $this->unset_columns));
        if(!$this->check_mDataprop())
          $aaData[$row_key] = array_values($aaData[$row_key]);
      }
      $sColumns = array_diff($this->columns, $this->unset_columns);
      $sColumns = array_merge_recursive($sColumns, array_keys($this->add_columns));
      $sOutput = array
      (
        'sEcho'                => intval($this->ci->input->post('sEcho')),
        'iTotalRecords'        => $iTotal,
        'iTotalDisplayRecords' => $iFilteredTotal,
        'aaData'               => $aaData,
        'sColumns'             => implode(',', $sColumns)
      );
      if(strtolower($charset) == 'utf-8')
        return json_encode($sOutput);
      else
        return $this->jsonify($sOutput);
    }
 
    protected function get_total_results($filtering = FALSE)
    {
      if($filtering)
        $this->get_filtering();
      foreach($this->joins as $val)
        $this->ci->db->join($val[0], $val[1], $val[2]);
      foreach($this->where as $val)
        $this->ci->db->where($val[0], $val[1], $val[2]);
      return $this->ci->db->count_all_results($this->table);
    }
  
    protected function exec_replace($custom_val, $row_data)
    {
      $replace_string = '';
      if(isset($custom_val['replacement']) && is_array($custom_val['replacement']))
      {
        foreach($custom_val['replacement'] as $key => $val)
        {
          $sval = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($val));
          if(preg_match('/(\w+)\((.*)\)/i', $val, $matches) && function_exists($matches[1]))
          {
            $func = $matches[1];
            $args = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[,]+/", $matches[2], 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            foreach($args as $args_key => $args_val)
            {
              $args_val = preg_replace("/(?<!\w)([\'\"])(.*)\\1(?!\w)/i", '$2', trim($args_val));
              $args[$args_key] = (in_array($args_val, $this->columns))? ($row_data[($this->check_mDataprop())? $args_val : array_search($args_val, $this->columns)]) : $args_val;
            }
            $replace_string = call_user_func_array($func, $args);
          }
          elseif(in_array($sval, $this->columns))
            $replace_string = $row_data[($this->check_mDataprop())? $sval : array_search($sval, $this->columns)];
          else
            $replace_string = $sval;
          $custom_val['content'] = str_ireplace('$' . ($key + 1), $replace_string, $custom_val['content']);
        }
      }
      return $custom_val['content'];
    }
   
    protected function check_mDataprop()
    {
      if (!$this->ci->input->post('mDataProp_0')) return FALSE;
      for($i = 0; $i < intval($this->ci->input->post('iColumns')); $i++)
        if(!is_numeric($this->ci->input->post('mDataProp_' . $i)))
          return TRUE;
      return FALSE;
    }
    
    protected function get_mDataprop()
    {
      $mDataProp = array();
      for($i = 0; $i < intval($this->ci->input->post('iColumns')); $i++)
        $mDataProp[] = $this->ci->input->post('mDataProp_' . $i);
      return $mDataProp;
    }
  
    protected function balanceChars($str, $open, $close)
    {
      $openCount = substr_count($str, $open);
      $closeCount = substr_count($str, $close);
      $retval = $openCount - $closeCount;
      return $retval;
    }

    protected function explode($delimiter, $str, $open='(', $close=')') 
    {
      $retval = array();
      $hold = array();
      $balance = 0;
      $parts = explode($delimiter, $str);
      foreach ($parts as $part) 
      {
        $hold[] = $part;
        $balance += $this->balanceChars($part, $open, $close);
        if ($balance < 1)
        {
          $retval[] = implode($delimiter, $hold);
          $hold = array();
          $balance = 0;
        }
      }
      if (count($hold) > 0)
        $retval[] = implode($delimiter, $hold);
      return $retval;
    }
   
    protected function jsonify($result = FALSE)
    {
      if(is_null($result)) return 'null';
      if($result === FALSE) return 'false';
      if($result === TRUE) return 'true';
      if(is_scalar($result))
      {
        if(is_float($result))
          return floatval(str_replace(',', '.', strval($result)));
        if(is_string($result))
        {
          static $jsonReplaces = array(array('\\', '/', '\n', '\t', '\r', '\b', '\f', '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
          return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $result) . '"';
        }
        else
          return $result;
      }
      $isList = TRUE;
      for($i = 0, reset($result); $i < count($result); $i++, next($result))
      {
        if(key($result) !== $i)
        {
          $isList = FALSE;
          break;
        }
      }
      $json = array();
      if($isList)
      {
        foreach($result as $value)
          $json[] = $this->jsonify($value);
        return '[' . join(',', $json) . ']';
      }
      else
      {
        foreach($result as $key => $value)
          $json[] = $this->jsonify($key) . ':' . $this->jsonify($value);
        return '{' . join(',', $json) . '}';
      }
    }
  }
/* End of file Datatables.php */
/* Location: ./application/libraries/Datatables.php */