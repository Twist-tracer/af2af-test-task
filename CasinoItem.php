<?PHP

/**
 * Class for Casino Item
 *
 */
class CasinoItem
{
    protected $sysname;
    protected $name;
    protected $logo;
    protected $speciall_offer;
    protected $total_bonus;
    protected $first_bonus;
    protected $payout;
    protected $rating;
    protected $aff_url;
	protected $order		= 0;
	protected $order_mob	= 0;
	protected $slide_img;

    /**
     * Constructor Casino Item
     *
     * @param       array       $array      List of properties for casino
     * @throws      Exception
     */
    public function __construct($array)
    {
        if(!is_array($array))
        {
            throw new Exception('Failed parameter $array. Should be array');
        }
        if(empty($array['sysname']))
        {
            throw new Exception('Expected sysname value for CasinoItem');
        }
        if(empty($array['name']))
        {
            $array['name'] = $array['sysname'];
        }

        foreach($array as $property => $value)
        {
            if(property_exists($this, $property))
            {
                $this->$property = $value;
            }
        }
		
		$this->sysname = strtolower($this->sysname);
		$this->order   = (int)$this->order;
		$this->order_mob = (int)$this->order_mob;
    }

    public function name()
    {
        return htmlspecialchars($this->name);
    }

    public function sysname()
    {
        return htmlspecialchars($this->sysname);
    }	
	
    public function logo_url($size = 'min')
    {
        if(empty($this->logo))
        {
            return '../img/brands/'.$this->sysname.'_'.$size.'.jpg';
        }

        return htmlspecialchars($this->logo);
    }
    public function slide_img_url()
    {

        return htmlspecialchars('../img/slide/'.$this->slide_img);
    }

    public function logo_image($size = 'min')
    {
       // return '<img src="'.$this->logo_url().'" alt="'.$this->name().'" width="120" height="60" border="0"/>';
        return '<img src="'.$this->logo_url($size).'" alt="'.$this->name().'"/>';
    }

    public function speciall_offer()
    {
        //return htmlspecialchars($this->speciall_offer);
        //return strtoupper($this->speciall_offer);
        return $this->speciall_offer;
    }

    public function total_bonus()
    {
        return htmlspecialchars($this->total_bonus);
    }

    public function first_bonus()
    {
        return htmlspecialchars($this->first_bonus);
    }

    public function payout()
    {
        return htmlspecialchars($this->payout);
    }

    public function rating()
    {
        return htmlspecialchars($this->rating);
    }

    public function order()
    {
        return $this->order;
    }
	
    public function order_mob()
    {
        return $this->order_mob;
    }
	
    public function gen_rating()
    {
        return '<img src="/img/stars-5.png" alt=""/>';
    }

    public function aff_url()
    {
        return htmlspecialchars($this->aff_url);
    }

    /**
     * Returns part of <a part>LINK</a>
     *
     * @return      string
     */
    public function aff_link_part($is_simple = false)
    {
		if($is_simple)
			{
				return $this->aff_url();
			}
        return 'href="'.$this->aff_url().'" target="_blank" rel="nofollow"';
    }
}