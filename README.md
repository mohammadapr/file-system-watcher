**How to run the project**

To start the file watcher, run this artisan command in terminal:

php artisan watch:files [file path to watch]

Example:

php artisan watch:files storage/app/watch (absloute path)

This command will start checking file changes in given folder, and do actions like optimize image, post JSON, extract ZIP, append text to .txt file, or replace deleted file with meme image.

**Challenges and Problems**

1. Different OS Support

The first problem was to build a system that works on Windows, Linux, and Mac. Some tools like inotify or fswatch are only for Linux or Mac. I use polling system, which works on all OS, but it uses more CPU.

2. Polling and Performance

In current version, every time we run the watcher, all files are checked. This is not good for big folders. It is better to save file hash or last change time in database, and just compare changed files.

3. Original File Not Saved

Project instructions did not say: should we save the original file before we change it (optimize image or edit text)? I think yes. It is good idea to save a .bak copy before we change. Then, we can restore it if something breaks.

4. No Full Error Handling

I did not have enough time to write full error handling for all parts. In real projects, we must use try/catch, logging, and retry system to make the system stable.

5. Async Work is Better for Heavy Tasks

Some tasks (like image optimize or HTTP post) take time. In Laravel, we can use job and queue to do these tasks in background. It makes system faster and more safe.

6. No Unit Test Written

In this version, I did not write unit tests. But because the project use Strategy pattern, it is easy to write test for each part (like Handlers or Context). Code is modular and clean, and easy to test.

**Final Implementation**

I used Chain of Responsibility pattern for handling files.

I used Strategy pattern for making system flexible.

Each handler do only one job (follow SRP).

I used interfaces and not concrete classes (follow DIP).

File change is checked with snapshot of file hashes.

**Extendability**

Add new file logic only need new handler class.

Polling system can change in future to event system.

Heavy works like image optimize can move to queue.

Code is modular and easy to test.

**Design Patterns Used**

- Strategy Pattern

Class BaseWatcherStrategy is abstract base class. It has watch() function. Other strategy classes can extend it and make different behaviors (like polling or real-time). This helps to change behavior without touching the main code.

- Dependency Injection

In classes like BaseWatcherStrategy and ChangeLogger, I inject all dependencies using constructor. I use interfaces, not direct class, so classes are loosely coupled. This is better for unit testing and changing parts of the system easily.

**Summary**

During development, I searched problems and learn more about Laravel structure. I also use AI help in some parts to make better code and build it faster.
