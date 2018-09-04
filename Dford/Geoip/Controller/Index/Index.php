<?php

namespace Dford\Geoip\Controller\Index;

use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Dford\Geoip\Controller\LoginHistoryAbstract
{
    protected $customerSession;
    protected $pageFactory;
    protected $factory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\View\Element\UiComponentFactory $factory,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->pageFactory = $pageFactory;
        $this->factory = $factory;
        $this->customerSession = $customerSession;
        return parent::__construct($context);
    }

    public function execute()
    {
        if ($this->customerSession->isLoggedIn()) {
            $isAjax = $this->getRequest()->isAjax();
            if ($isAjax) {
                $component = $this->factory->create($this->_request->getParam('namespace'));
                $this->prepareComponent($component);
                $this->_response->appendBody((string) $component->render());
            } else {
                $resultPage = $this->pageFactory->create();
                return $resultPage;
            }
        } else {
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('customer/account/login');
            return $resultRedirect;
        }
    }

    protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}
