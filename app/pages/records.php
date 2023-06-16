<?php
require '../vendor/autoload.php';
$direcTory = new DirEctory\Directories();
$res = $direcTory->getLimDirectory();
?>
<div class="rec-cont overflow-x-auto shadow-md sm:rounded-lg mx-auto mt-4 px-4">
     <div class="pb-4 bg-white dark:bg-gray-900">
          <label for="table-search" class="sr-only">Search</label>
          <form action="#" method="post" class="flex">
               <div class="relative mt-1 flex-grow">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                         <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd"
                                   d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                   clip-rule="evenodd"></path>
                         </svg>
                    </div>
                    <input type="text" id="table-search"
                         class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                         placeholder="Search for items">
               </div>
               <div class="p-1"></div>
               <div class="mt-1">
                    <button type="submit"
                         class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd"
                                   d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                   clip-rule="evenodd"></path>
                         </svg>
                         <span class="sr-only">Icon description</span>
                    </button>
               </div>
               <div class="divider"></div>
               <div class="relative mt-1 flex-grow">
                    <button onclick="refreshSync(event)"
                         class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd"
                                   d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                   clip-rule="evenodd"></path>
                         </svg>
                         <span class="ml-2">Sync</span>
                    </button>
               </div>
          </form>
     </div>
     <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
                    <th scope="col" class="px-6 py-3">
                         Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Student Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Birthday
                    </th>
                    <!-- <th scope="col" class="px-6 py-3">
                         Nationality
                    </th> -->
                    <th scope="col" class="px-6 py-3">
                         Disposition
                    </th>
                    <!-- <th scope="col" class="px-6 py-3">
                         Guardian
                    </th> -->
                    <th scope="col" class="px-6 py-3">
                         Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                         Image
                    </th>
               </tr>
          </thead>
          <tbody>
               <?php if ($res != null || $res != '') { ?>
                    <?php foreach ($res as $r) { ?>
                         <tr
                              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                   <?php echo $r['id'] ?>
                              </th>
                              <td class="px-6 py-4">
                                   <?php echo $r['uuid'] ?>
                              </td>
                              <td class="px-6 py-4">
                                   <?php echo $r['lastname'] . ' ' . $r['firstname'] . ' ' . $r['middlename'] ?>
                              </td>
                              <td class="px-6 py-4">
                                   <?php echo $r['email'] ?>
                              </td>
                              <td class="px-6 py-4">
                                   <?php echo $r['phone'] ?>
                              </td>
                              <td class="px-6 py-4">
                                   <?php echo $r['address'] ?>
                              </td>
                              <td class="px-6 py-4">
                                   <?php echo $r['birthday'] ?>
                              </td>
                              <!-- <td class="px-6 py-4">
                              <?php echo $r['nationality'] ?>
                         </td> -->
                              <td class="px-6 py-4">
                                   <?php echo $r['disposition'] ?>
                              </td>
                              <!-- <td class="px-6 py-4">
                              <?php echo $r['guardian_fullname'] ?>
                         </td> -->

                              <td class="px-6 py-4">
                                   <?php if ($r['status'] === 'enrolled') { ?>
                                        <span
                                             class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Enrolled</span>
                                   <?php } elseif ($r['status'] === 'not_enrolled') { ?>
                                        <span
                                             class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">Not
                                             Enrolled</span>
                                   <?php } ?>
                              </td>
                              <td class="px-6 py-4">
                                   <?php if ($r['img_urls'] === null || $r['img_urls'] === '') { ?>
                                        <a href="?page=addphoto?id=<?php echo $r['id'] ?>"
                                             class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                             Add Image
                                        </a>
                                   <?php } else {
                                        echo $r['img_urls'];
                                   } ?>
                              </td>
                         </tr>
                    <?php } ?>
               <?php } else { ?>
                    <tr
                         class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                         <th scope="row" rowspan="10"
                              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                              List is empty
                         </th>
                    </tr>
               <?php } ?>
          </tbody>
     </table>
</div>