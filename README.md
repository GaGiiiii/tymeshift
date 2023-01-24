# LIST OF THE UPDATES

### Global updates:
- Every file is PSR-12 compatible now.
- Methods documented with PHPDocs.

### Suggestions:
- Return lines should ALWAYS have an empty line above them so the code is more readable, except if return line is the only line in the code block. 
- Create DTO's for Domains.

### Dockerfile updates:
- Removed volume from docker run command and added composer install to the Dockerfile (We should not be entering the container after build).
- Removed maintainer (deprecated), removed add (copy is better practice), updated composer install (more efficient and shorter).

### BaseCollection updates:
- getIterator() returns Traversable now.
- count() returns int now.
- offsetExists() returns bool now.
- offsetSet() returns void.
- offsetUnset() returns void.
- getAssoc() returns BaseCollection instead of Collection now.

### Exceptions updates:
- Added protected visibility to the message variable.
- Updated StorageDataMissingException.
- Created new Exceptions: 
  - DataNotInsertedException
  - DataNotUpdatedException
  - DataNotDeletedException
  
### Interfaces updates:
- Added new method (createCollection) to the FactoryInterface.
- Added new methods to the RepositoryInterface and to the StorageInterface:
  - getAll
  - insert
  - update
  - delete

### Schedule domain updates:
- Added new class ScheduleCollection.
- Added new class ScheduleStorageInterface.
- Added new class ScheduleService.
- Added new method (createCollection) to the ScheduleFactory.
- Updated class ScheduleRepository.
- Updated class ScheduleStorage.

### Task domain updates:
- Updated class TaskEntity.
- Added new class TaskStorageInterface.
- Updated class TaskFactory.
- Updated class ScheduleRepository.
- Updated class ScheduleStorage.
