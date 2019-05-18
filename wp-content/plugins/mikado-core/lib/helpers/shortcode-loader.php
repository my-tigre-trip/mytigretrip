<?php
namespace GoTravel\Modules\Shortcodes\Lib;

use GoTravel\Modules\Shortcodes\Accordion\Accordion;
use GoTravel\Modules\Shortcodes\AccordionTab\AccordionTab;
use GoTravel\Modules\Shortcodes\AnimationsHolder\AnimationsHolder;
use GoTravel\Modules\Shortcodes\Blockquote\Blockquote;
use GoTravel\Modules\Shortcodes\BlogCarousel\BlogCarousel;
use GoTravel\Modules\Shortcodes\BlogList\BlogList;
use GoTravel\Modules\Shortcodes\BlogSlider\BlogSlider;
use GoTravel\Modules\Shortcodes\Button\Button;
use GoTravel\Modules\Shortcodes\CallToAction\CallToAction;
use GoTravel\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTable;
use GoTravel\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder;
use GoTravel\Modules\Shortcodes\Countdown\Countdown;
use GoTravel\Modules\Shortcodes\Counter\Counter;
use GoTravel\Modules\Shortcodes\CustomFont\CustomFont;
use GoTravel\Modules\Shortcodes\Dropcaps\Dropcaps;
use GoTravel\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use GoTravel\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use GoTravel\Modules\Shortcodes\GoogleMap\GoogleMap;
use GoTravel\Modules\Shortcodes\Highlight\Highlight;
use GoTravel\Modules\Shortcodes\Icon\Icon;
use GoTravel\Modules\Shortcodes\IconListItem\IconListItem;
use GoTravel\Modules\Shortcodes\IconProgressBar\IconProgressBar;
use GoTravel\Modules\Shortcodes\IconWithText\IconWithText;
use GoTravel\Modules\Shortcodes\ImageGallery\ImageGallery;
use GoTravel\Modules\Shortcodes\InfoBox\InfoBox;
use GoTravel\Modules\Shortcodes\InfoItem\InfoItem;
use GoTravel\Modules\Shortcodes\InfoItems\InfoItems;
use GoTravel\Modules\Shortcodes\Message\Message;
use GoTravel\Modules\Shortcodes\PieCharts\PieChartBasic\PieChartBasic;
use GoTravel\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartDoughnut;
use GoTravel\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartPie;
use GoTravel\Modules\Shortcodes\PieCharts\PieChartWithIcon\PieChartWithIcon;
use GoTravel\Modules\Shortcodes\PricingTables\PricingTables;
use GoTravel\Modules\Shortcodes\PricingTable\PricingTable;
use GoTravel\Modules\Shortcodes\Process\ProcessHolder;
use GoTravel\Modules\Shortcodes\Process\ProcessItem;
use GoTravel\Modules\Shortcodes\ProgressBar\ProgressBar;
use GoTravel\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use GoTravel\Modules\Shortcodes\SectionTitle\SectionTitle;
use GoTravel\Modules\Shortcodes\Separator\Separator;
use GoTravel\Modules\Shortcodes\SocialShare\SocialShare;
use GoTravel\Modules\Shortcodes\Tabs\Tabs;
use GoTravel\Modules\Shortcodes\Tab\Tab;
use GoTravel\Modules\Shortcodes\Team\Team;
use GoTravel\Modules\Shortcodes\UnorderedList\UnorderedList;
use GoTravel\Modules\Shortcodes\VerticalProgressBar\VerticalProgressBar;
use GoTravel\Modules\Shortcodes\VideoBanner\VideoBanner;
use GoTravel\Modules\Shortcodes\VideoButton\VideoButton;
use GoTravel\Modules\Shortcodes\WorkingHours\WorkingHours;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
    /**
     * @var private instance of current class
     */
    private static $instance;
    /**
     * @var array
     */
    private $loadedShortcodes = array();

    /**
     * Private constuct because of Singletone
     */
    private function __construct() {
    }

    /**
     * Private sleep because of Singletone
     */
    private function __wakeup() {
    }

    /**
     * Private clone because of Singletone
     */
    private function __clone() {
    }

    /**
     * Returns current instance of class
     * @return ShortcodeLoader
     */
    public static function getInstance() {
        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Adds new shortcode. Object that it takes must implement ShortcodeInterface
     *
     * @param ShortcodeInterface $shortcode
     */
    private function addShortcode(ShortcodeInterface $shortcode) {
        if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
            $this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
        }
    }

    /**
     * Adds all shortcodes.
     *
     * @see ShortcodeLoader::addShortcode()
     */
    private function addShortcodes() {
	    $this->addShortcode(new Accordion());
	    $this->addShortcode(new AccordionTab());
	    $this->addShortcode(new AnimationsHolder());
	    $this->addShortcode(new Blockquote());
	    $this->addShortcode(new BlogCarousel());
	    $this->addShortcode(new BlogList());
	    $this->addShortcode(new BlogSlider());
	    $this->addShortcode(new Button());
	    $this->addShortcode(new CallToAction());
	    $this->addShortcode(new ComparisonPricingTablesHolder());
	    $this->addShortcode(new ComparisonPricingTable());
	    $this->addShortcode(new Counter());
	    $this->addShortcode(new Countdown());
	    $this->addShortcode(new CustomFont());
	    $this->addShortcode(new Dropcaps());
	    $this->addShortcode(new ElementsHolder());
	    $this->addShortcode(new ElementsHolderItem());
	    $this->addShortcode(new GoogleMap());
	    $this->addShortcode(new Highlight());
	    $this->addShortcode(new Icon());
	    $this->addShortcode(new IconListItem());
	    $this->addShortcode(new IconProgressBar());
	    $this->addShortcode(new IconWithText());
	    $this->addShortcode(new ImageGallery());
	    $this->addShortcode(new InfoBox());
	    $this->addShortcode(new InfoItem());
	    $this->addShortcode(new InfoItems());
	    $this->addShortcode(new Message());
	    $this->addShortcode(new PieChartBasic());
	    $this->addShortcode(new PieChartPie());
	    $this->addShortcode(new PieChartDoughnut());
	    $this->addShortcode(new PieChartWithIcon());
	    $this->addShortcode(new PricingTables());
	    $this->addShortcode(new PricingTable());
	    $this->addShortcode(new ProcessHolder());
	    $this->addShortcode(new ProcessItem());
	    $this->addShortcode(new ProgressBar());
	    $this->addShortcode(new SectionTitle());
	    $this->addShortcode(new SectionSubtitle());
	    $this->addShortcode(new Separator());
	    $this->addShortcode(new SocialShare());
	    $this->addShortcode(new Tabs());
	    $this->addShortcode(new Tab());
	    $this->addShortcode(new Team());
	    $this->addShortcode(new UnorderedList());
	    $this->addShortcode(new VerticalProgressBar());
	    $this->addShortcode(new VideoButton());
	    $this->addShortcode(new VideoBanner());
	    $this->addShortcode(new WorkingHours());
    }

    /**
     * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
     * of each shortcode object
     */
    public function load() {
        $this->addShortcodes();

        foreach($this->loadedShortcodes as $shortcode) {
            add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
        }
    }
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();