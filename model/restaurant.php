<?php
    include_once "./model/user.php";
    include_once "./model/file.php";
    
    class Restaurant
    {  
        private $id;
        private $name = "";
        private $image;
        private $imageId;
        // address
        private $country = "Belgium";
        private $city;
        private $line;
        private $number;
        private $location;
        // coordinates
        private $lat;
        private $lon;
        // information
        private $createdBy;
        private $createdById;
        private $creationDate;
        private $updateDate;

        private $distance = null;
        
        public function getId(): ?int
        {
        return $this->id;
        }
        
        public function getImage(): ? File
        {
            if($this->image == null && $this->imageId != null) 
            {
                $db = new DbHelper();
                $this->image = $db->retrieve("files", $this->imageId);
            }
            return $this->image;
        }
        public function getCreatedBy(): ? User
        {
            if($this->createdBy == null && $this->createdById != null)
            {
                $db = new DbHelper();
                $this->createdBy = $db->retrieve("users", $this->createdById);
            }
            return $this->createdBy;
        }
        

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
            return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
            $this->country = $country;

            return $this;
        }

        /**
         * Get the value of city
         */ 
        public function getCity()
        {
            return $this->city;
        }

        /**
         * Set the value of city
         *
         * @return  self
         */ 
        public function setCity($city)
        {
            $this->city = $city;

            return $this;
        }

        /**
         * Get the value of line
         */ 
        public function getLine()
        {
            return $this->line;
        }

        /**
         * Set the value of line
         *
         * @return  self
         */ 
        public function setLine($line)
        {
            $this->line = $line;

            return $this;
        }

        /**
         * Get the value of number
         */ 
        public function getNumber()
        {
            return $this->number;
        }

        /**
         * Set the value of number
         *
         * @return  self
         */ 
        public function setNumber($number)
        {
            $this->number = $number;

            return $this;
        }

        /**
         * Get the value of location
         */ 
        public function getLocation()
        {
            return $this->location;
        }

        /**
         * Set the value of location
         *
         * @return  self
         */ 
        public function setLocation($location)
        {
            $this->location = $location;

            return $this;
        }

        /**
         * Get the value of lat
         */ 
        public function getLat() : ?float
        {
            return $this->lat;
        }

        /**
         * Set the value of lat
         *
         * @return  self
         */ 
        public function setLat($lat)
        {
            $this->lat = $lat;

            return $this;
        }

        /**
         * Get the value of lon
         */ 
        public function getLon() : ?float
        {
            return $this->lon;
        }

        /**
         * Set the value of lon
         *
         * @return  self
         */ 
        public function setLon($lon)
        {
            $this->lon = $lon;

            return $this;
        }

        /**
         * Get the value of updateDate
         */ 
        public function getUpdateDate()
        {
            return $this->updateDate;
        }

        /**
         * Get the value of creationDate
         */ 
        public function getCreationDate()
        {
            return $this->creationDate;
        }

        /**
         * Get the value of createdById
         */ 
        public function getCreatedById() : int
        {
            return $this->createdById;
        }

        /**
         * Set the value of createdById
         *
         * @return  self
         */ 
        public function setCreatedById($createdById)
        {
            $this->createdById = $createdById;

            return $this;
        }

        /**
         * Get the value of imageId
         */ 
        public function getImageId() : ?int
        {
            return $this->imageId;
        }

        /**
         * Set the value of imageId
         *
         * @return  self
         */ 
        public function setImageId($imageId)
        {
            $this->imageId = $imageId;

            return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of distance
         */ 
        public function getDistance()
        {
                return number_format((float)$this->distance, 2, '.', '');
        }

        /**
         * Set the value of distance
         *
         * @return  self
         */ 
        public function setDistance($distance)
        {
                $this->distance = $distance;

                return $this;
        }
    }