<?php
use Happyr\LinkedIn\LinkedIn as LinkedInParent;

class LinkedIn extends LinkedInParent
{
  public function getAccessToken()
  {
      if ($this->accessToken === null) {
          if (null !== $newAccessToken = $this->getAuthenticator()->fetchNewAccessToken($this->getUrlGenerator())) {
              $newAccessToken = unserialize(serialize($newAccessToken));
              $this->setAccessToken($newAccessToken);
          }
      }

      return $this->accessToken;
  }
}