<?php
namespace recyger\JIRARESTClient\services\api\v2\myself;

use recyger\JIRARESTClient\common\authentivation\HTTPBasicAuthenticationRequestProcessor;
use recyger\JIRARESTClient\common\exception\RequestException;
use recyger\JIRARESTClient\common\Parental;
use recyger\JIRARESTClient\common\RequestBase;
use recyger\JIRARESTClient\common\RequestProcessorHelper;

class MyselfResource extends Parental
{
    protected $_name  = 'myself';
    /**
     * @type MyselfEntry
     */
    protected $_entry = null;

    public function get() : MyselfEntry
    {
        if (is_null($this->_entry)) {
            $request  = new RequestBase($this->getURL(), RequestBase::METHOD_GET);
            $response = $this->processRequest($request);
            $this->_entry = new MyselfEntry($response);
        }
        
        return $this->_entry;
    }

    public function update(string $password) : bool
    {
        $entry = $this->get();
        $request = new RequestBase(
            $this->getURL(),
            RequestBase::METHOD_PUT,
            array_merge(
                [
                    'password' => $password,
                ],
                $entry->getAttributeForUpdate()
            )
        );
        try {
            $entry->setAttributes($this->processRequest($request));
            return true;
        } catch (RequestException $e) {
            return false;
        }
    }

    public function changeMyPassword(string $currentPassword, string $newPassword) : bool
    {
        $entry = $this->get();
        $request = new RequestBase(
            $this->getURL() . '/password',
            RequestBase::METHOD_PUT,
            [
                'password'        => $newPassword,
                'currentPassword' => $currentPassword,
            ]
        );
        try {
            $this->processRequest($request);
            $this->setProcessor(
                RequestProcessorHelper::AUTHENTICATION,
                new HTTPBasicAuthenticationRequestProcessor(
                    $entry->name,
                    $newPassword
                )
            );
            return true;
        } catch (RequestException $e) {
            return false;
        }
    }
}
