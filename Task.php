<?php

namespace Infinity;


require_once "Utils/FileSystemUtils.php";
require_once "Utils/StringUtils.php";
require_once "CSVParser.php";
require_once "CSVValidator.php";
require_once "Repositories/CSVEventRepository.php";
require_once "MySQL.php";
require_once "Factories/EventFactory.php";

use Infinity\Repositories\CSVEventRepository;
use Infinity\Utils\FileSystemUtils;

class Task
{
    /** @var  CSVParser */
    private $CSVParser;
    
    /** @var  CSVValidator */
    private $CSVValidator;
    
    /** @var  CSVEventRepository */
    private $CSVRepository;
    
    /** @var  EventFactoryInterface */
    private $eventFactory;

    public function __construct(
        ParserInterface $CSVParser,
        ValidatorInterface $CSVValidator,
        EventRepositoryInterface $CSVRepository,
        EventFactoryInterface $eventFactory
    ) {
        $this->CSVParser = $CSVParser;
        $this->CSVValidator = $CSVValidator;
        $this->CSVRepository = $CSVRepository;
        $this->eventFactory= $eventFactory;
    }

    public function run()
    {
        $pathBeforeProcessing = "uploaded";
        $pathAfterProcessing = "processed";
        
        if (FileSystemUtils::folderExists($pathBeforeProcessing)) {
            $dir = new \DirectoryIterator($pathBeforeProcessing);
            
            foreach ($dir as $fileInfo) {
                $filename = $fileInfo->getFilename();

                if (FileSystemUtils::isCSVFile($filename)) {
                    $data = $this->CSVParser->parse($pathBeforeProcessing . "/" . $filename);

                    if ($this->CSVValidator->validate($data)) {
                        foreach ($data as $eventData) {
                            $event = $this->eventFactory->make($eventData);
                            $this->CSVRepository->save($event);
                        }
                        FileSystemUtils::fileMove($filename, $pathBeforeProcessing, $pathAfterProcessing);
                    }
                }
            }
        } else {
            echo "No CSVs found in the 'uploaded' directory.";
        }
    }
}

(new Task(
    new CSVParser(),
    new CSVValidator(),
    new CSVEventRepository(
        new MySQL("localhost", "database", 3306, "root", "password")
    ),
    new EventFactory()
))->run();