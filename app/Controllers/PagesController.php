<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\LotModel;
use App\Models\PropertyDistanceModel;
use App\Models\PropertyValuationModel; 
use App\Models\DocumentModel;
use CodeIgniter\Pager\Pager;
use CodeIgniter\Pagination\PagerRendererInterface;
use CodeIgniter\View\RendererInterface;
use CodeIgniter\Pager\PagerRenderer;
use Config\Pager as PagerConfig;
use Config\Services;
use CodeIgniter\View\View;
use CodeIgniter\Files\File;
use CodeIgniter\Files\Exceptions\FileNotFoundException;



class PagesController extends BaseController
{
    public function index()
    {
        return view('homepage');
    }

    public function about()
    {
        return view('about');
    }

    public function map()
    {
        $lot = '1'; // Replace with the actual value you want to switch on

        switch ($lot) {
            case '1':
                $lotModel = new LotModel();
                $lots = $lotModel->findAll();
                break;
            case '2':
                $lotModel = new LotModel();
                $lots = $lotModel->findAll();
                break;
            default:
                return redirect()->back()->withInput()->with('error', 'Lot number not found.');
        }

        $data = [
            'lots' => $lots,
        ]; 

        return view('map', $data);
    }

    public function adminmap()
    {
        $lot = '1'; // Replace with the actual value you want to switch on

        switch ($lot) {
            case '1':
                $lotModel = new LotModel();
                $lots = $lotModel->findAll();
                break;
            case '2':
                $lotModel = new LotModel();
                $lots = $lotModel->findAll();
                break;
            default:
                return redirect()->back()->withInput()->with('error', 'Lot number not found.');
        }

        $data = [
            'lots' => $lots,
        ]; 

        return view('adminmap', $data);
    }

    public function search()
    {

        $lotModel = new LotModel();
    $pagerConfig = new PagerConfig();
    $view = Services::renderer();

    $pager = new Pager($pagerConfig, $view);

    $currentPage = (int) $this->request->getVar('page');
    $lots = $lotModel->paginate(10, 'default', $currentPage);

    $data = [
        'pager' => $lotModel->pager->links('default', 'default_full'), 
        'lots' => $lots,
    ];

    echo view('search', $data);
    }

    public function adminHome()
    {       
        $data = [];

        return view('adminhome', $data);
    }

    public function adminAbout()
    {
        return view('adminabout');
    }

    public function adminSearch()
    {
        $lotModel = new LotModel();
        $pagerConfig = new PagerConfig();
        $view = Services::renderer();

        $pager = new Pager($pagerConfig, $view);

        $currentPage = (int) $this->request->getVar('page');
        $lots = $lotModel->paginate(10, 'default', $currentPage);

        $data = [
            'pager' => $lotModel->pager->links('default', 'default_full'), 
            'lots' => $lots,
        ];

        echo view('adminsearch', $data);
    }

    public function searchinfo()
    {
        $lotModel = new LotModel();
        $propertyDistanceModel = new PropertyDistanceModel();
        $propertyValuationModel = new PropertyValuationModel();

        $lotNo = $this->request->getVar('lot_no');

        // Validate the lot number
        $validation = $this->validate([
            'lot_no' => 'required|numeric|is_not_unique[lot_details.lot_no]',
        ]);

        if (!$validation) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Lot number is valid, proceed with fetching data
        $lot = $lotModel->where('lot_no', $lotNo)->first();

        if (!$lot) {
            // Lot number not found, show error message
            return redirect()->back()->withInput()->with('error', 'Lot number not found.');
        }

        // Fetch multiple property distances
        $propertyDistances = $propertyDistanceModel->where('lot_id', $lot['id'])->findAll();

        // Fetch multiple property valuations
        $propertyValuations = $propertyValuationModel->where('lot_id', $lot['id'])->findAll();

        $data = [
            'lot' => $lot,
            'propertyDistances' => $propertyDistances, // Pass the property distances array to the view
            'propertyValuations' => $propertyValuations, // Pass the property valuations array to the view
        ];

        return view('searchinfo', $data);
    }

    public function usersearch()
    {
        $lotModel = new LotModel();
        $propertyDistanceModel = new PropertyDistanceModel();
        $propertyValuationModel = new PropertyValuationModel();

        $lotNo = $this->request->getVar('lot_no');

        // Validate the lot number
        $validation = $this->validate([
            'lot_no' => 'required|numeric|is_not_unique[lot_details.lot_no]',
        ]);

        if (!$validation) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Lot number is valid, proceed with fetching data
        $lot = $lotModel->where('lot_no', $lotNo)->first();

        if (!$lot) {
            // Lot number not found, show error message
            return redirect()->back()->withInput()->with('error', 'Lot number not found.');
        }

        // Fetch multiple property distances
        $propertyDistances = $propertyDistanceModel->where('lot_id', $lot['id'])->findAll();

        // Fetch multiple property valuations
        $propertyValuations = $propertyValuationModel->where('lot_id', $lot['id'])->findAll();

        $data = [
            'lot' => $lot,
            'propertyDistances' => $propertyDistances, // Pass the property distances array to the view
            'propertyValuations' => $propertyValuations, // Pass the property valuations array to the view
        ];

        return view('usersearch', $data);
    }

    

    public function viewlot($lotId)
    {
        $lotModel = new LotModel();
        $propertyDistanceModel = new PropertyDistanceModel();
        $propertyValuationModel = new PropertyValuationModel();

        $documentModel = new DocumentModel();
    
        // Fetch the lot information
        $lot = $lotModel->find($lotId);
    
        if (!$lot) {
            // Lot not found, redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'Lot not found.');
        }
    
        // Fetch property distances
        $propertyDistances = $propertyDistanceModel->where('lot_id', $lotId)->findAll();
    
        // Fetch property valuations
        $propertyValuations = $propertyValuationModel->where('lot_id', $lotId)->findAll();

        // Fetch property documents
        $documents = $documentModel->where('lot_id', $lotId)->findAll();
    
        $data = [
            'lot' => $lot,
            'propertyDistances' => $propertyDistances,
            'propertyValuations' => $propertyValuations,
            'documents' => $documents,
        ];
    
        return view('viewlot', $data);
    }



    public function reports()
    {
        $lotModel = new LotModel();
        $documentModel = new DocumentModel();


        // Get the total area of all the lots
        $totalArea = $lotModel->db->query('SELECT SUM(size_of_area) AS total_area FROM lot_details')->getRow()->total_area;

        // Get the total number of lots
        $totalLot = $lotModel->countAll();
        $totalDocs = $documentModel->countAll();

        // Pass the calculated values to the view
        $data['totalArea'] = $totalArea;
        $data['totalLot'] = $totalLot + $totalDocs;
        $data['totalLotNoDoc'] = $totalLot;
        $data['totalDocs'] = $totalDocs;

        return view('reports', $data);
    }  

    public function documents()
    {
        $lotModel = new LotModel();
        $lots = $lotModel->findAll();


        $data = [
            'lots' => $lots,
        ];

        return view('documents', $data);
    }

    public function download(){

    }

    public function add()
{
    $data = [];
    helper(['form']);

    $validationRules = [
        'lot_no' => 'required|numeric|is_unique[lot_details.lot_no]',
        'cad_no' => 'numeric',
        'size_of_area' => 'required|regex_match[/^\d{6} meters$/]',
        'location' => 'required|alpha_numeric',
        'phase' => 'regex_match[/^[a-zA-Z0-9\s]{1,12}$/]',
        'land_owner' => 'required|max_length[18]',
        'status' => 'in_list[Active,Inactive,active,inactive]',
        'distance.0.bllm' => 'numeric|max_length[7]',
        'distance.0.distance_to_point1' => 'regex_match[/^\d{1,9} meters$/]',
        'valuation.0.valuation_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
        'valuation.0.tree_valuation_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
        'valuation.0.disturbance_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
        'valuation.0.house_structure_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
    ];
    
    $validationMessages = [
        'lot_no' => [
            'required' => 'The Lot Number field is required.',
            'numeric' => 'The Lot Number field must be numeric.',
        ],
        'size_of_area' => [
            'required' => 'The Size of Area field is required.',
            'regex_match' => 'The Size of Area field must be 6 digits followed by "meters".',
        ],
        'cad_no' => [
            'numeric' => 'The Cad Number field must be numeric.',
        ],
        'location' => [
            'required' => 'The Location field is required.',
            'alpha_numeric' => 'The Location field must contain only alphanumeric characters.',
        ],
        'phase' => [
            'regex_match' => 'The Phase field must be alphanumeric and have a maximum length of 12.',
        ],
        'land_owner' => [
            'required' => 'The Land Owner field is required.',
            'max_length' => 'The Land Owner field cannot exceed 18 characters.',
        ],
        'status' => [
            'in_list' => 'The selected Status is invalid.',
        ],
        'distance.0.bllm' => [
            'numeric' => 'The BLLM field must be numeric.',
            'max_length' => 'The BLLM field cannot exceed 7 characters.',
        ],
        'distance.0.distance_to_point1' => [
            'regex_match' => 'The Distance to Point 1 field must be numeric followed by "meters".',
        ],
        'valuation.0.valuation_amount' => [
            'regex_match' => 'The Valuation amount field must start with "PHP " followed by up to 10 digits (with optional comma).',
        ],
        'valuation.0.tree_valuation_amount' => [
            'regex_match' => 'The Tree valuation amount field must start with "PHP " followed by up to 10 digits (with optional comma).',
        ],
        'valuation.0.disturbance_amount' => [
            'regex_match' => 'The Disturbance amount field must start with "PHP " followed by up to 10 digits (with optional comma).',
        ],
        'valuation.0.house_structure_amount' => [
            'regex_match' => 'The House structure amount field must start with "PHP " followed by up to 10 digits (with optional comma).',
        ],
    ];
    

    if ($this->request->getMethod() == 'post') {
        // Validate the form data
        if (!$this->validate($validationRules,$validationMessages)) {
            $data['validation'] = $this->validator;
        } else {

        // Retrieve the form data
        $newData = [
            'lot_no' => $this->request->getVar('lot_no'),
            'cad_no' => $this->request->getVar('cad_no'),
            'size_of_area' => $this->request->getVar('size_of_area'),
            'location' => $this->request->getVar('location'),
            'phase' => $this->request->getVar('phase'),
            'land_owner' => $this->request->getVar('land_owner'),
            'status' => $this->request->getVar('status'),
        ];

        // Instantiate models
        $lotModel = new LotModel();
        $propertyDistanceModel = new PropertyDistanceModel();
        $propertyValuationModel = new PropertyValuationModel();

        // Attempt to save data
        try {
            // Save lot details
            $lotModel->save($newData);
            $lotId = $lotModel->insertID(); // Get the ID of the inserted lot

            // Save property distance
            $distanceData = $this->request->getVar('distance');
            foreach ($distanceData as $distance) {
                $propertyDistanceModel->save([
                    'lot_id' => $lotId,
                    'bllm' => $distance['bllm'],
                    'distance_to_point1' => $distance['distance_to_point1'],
                ]);
            }

            // Save property valuation
            $valuationData = $this->request->getVar('valuation');
            foreach ($valuationData as $valuation) {
                $propertyValuationModel->save([
                    'lot_id' => $lotId,
                    'valuation_amount' => $valuation['valuation_amount'],
                    'tree_valuation_amount' => $valuation['tree_valuation_amount'],
                    'disturbance_amount' => $valuation['disturbance_amount'],
                    'house_structure_amount' => $valuation['house_structure_amount'],
                ]);
            }

            // Handle file upload
            $file = $this->request->getFile('fileToUpload');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();

                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    // File uploaded successfully, now save the details in the database
                    $documentModel = new DocumentModel();

                    $data = [
                        'lot_id' => $lotId,
                        'file_name' => $file->getName(),
                        'original_name' => $file->getClientName(),
                        'upload_date' => date('Y-m-d H:i:s'),
                        'file_path' => 'uploads/' . $newName
                    ];

                    $documentModel->insert($data);
                }
            }

            // Pass the new land detail to the view
            $data['lot_no'] = $newData['lot_no'];
            $data['cad_no'] = $newData['cad_no'];
            $data['size_of_area'] = $newData['size_of_area'];
            $data['location'] = $newData['location'];

            // Redirect to success page
            return redirect()->to('/documents/')->with('newData', $data);

        } catch (\Exception $e) {
            // Handle any exceptions thrown during the save process
            log_message('error', $e->getMessage());
            // You can customize the error handling based on your requirements
            // For example, you can display an error message or redirect to an error page
            return redirect()->back()->withInput()->with('error', 'An error occurred while saving the data.');
        }
    }
}

    // Load the view to display the form
    return view('add', $data);
}


public function update($lotId)
{
    $data = [];
    helper(['form']);

    // Instantiate models
    $lotModel = new LotModel();
    $propertyDistanceModel = new PropertyDistanceModel();
    $propertyValuationModel = new PropertyValuationModel();

    // Get the data of the lot to be updated
    $lot = $lotModel->find($lotId);
    $propertyDistance = $propertyDistanceModel->where('lot_id', $lotId)->findAll();
    $propertyValuation = $propertyValuationModel->where('lot_id', $lotId)->findAll();

    // Populate the form with the data
    $data['lotId'] = $lotId;
    $data['lot'] = $lot;
    $data['propertyDistance'] = $propertyDistance;
    $data['propertyValuation'] = $propertyValuation;

    if ($this->request->getMethod() == 'post') {
        $validationRules = [
            'cad_no' => 'numeric',
            'size_of_area' => 'required|regex_match[/^\d{6} meters$/]',
            'location' => 'required|alpha_numeric',
            'phase' => 'regex_match[/^[a-zA-Z0-9\s]{1,12}$/]',
            'land_owner' => 'required|max_length[18]',
            'status' => 'required|in_list[Active,Inactive,active,inactive]',
            'propertyDistances.*.distance_to_point1' => 'regex_match[/^\d{1,9} meters$/]',
            'propertyValuations.*.valuation_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
            'propertyValuations.*.tree_valuation_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
            'propertyValuations.*.disturbance_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
            'propertyValuations.*.house_structure_amount' => 'regex_match[/^PHP \d{1,10}(,\d{1,3})?$/]',
        ];

        $validationMessages = [
            'lot_no' => [
                'required' => 'The Lot No. field is required.',
            ],
            'size_of_area' => [
                'required' => 'The Size of Area field is required.',
                'regex_match' => 'The Size of Area field must be 6 digits followed by "meters".',
            ],
            'cad_no' => [
                'numeric' => 'The Cad Number field must be numeric.',
            ],
            'location' => [
                'required' => 'The Location field is required.',
                'alpha_numeric' => 'The Location field must contain only alphanumeric characters.',
            ],
            'phase' => [
                'regex_match' => 'The Phase field must be alphanumeric and have a maximum length of 12.',
            ],
            'land_owner' => [
                'required' => 'The Land Owner field is required.',
                'max_length' => 'The Land Owner field cannot exceed 18 characters.',
            ],
            'status' => [
                'required' => 'The Status field is required.',
                'in_list' => 'The selected Status is invalid.',
            ],
            'propertyDistances.*.distance_to_point1' => [
                'regex_match' => 'The Distance to Point 1 field must be a numeric value followed by "meters".',
            ],
            'propertyValuations.*.valuation_amount' => [
                'regex_match' => 'The Valuation Amount field must be in the format "PHP" followed by a numeric value with optional thousands separator.',
            ],
            'propertyValuations.*.tree_valuation_amount' => [
                'regex_match' => 'The Tree Valuation Amount field must be in the format "PHP" followed by a numeric value with optional thousands separator.',
            ],
            'propertyValuations.*.disturbance_amount' => [
                'regex_match' => 'The Disturbance Amount field must be in the format "PHP" followed by a numeric value with optional thousands separator.',
            ],
            'propertyValuations.*.house_structure_amount' => [
                'regex_match' => 'The House Structure Amount field must be in the format "PHP" followed by a numeric value with optional thousands separator.',
            ],
        ];

        if ($this->validate($validationRules, $validationMessages)) {
            // Save the updated lot data
            $lotData = [
                'lot_no' => $this->request->getPost('lot_no'),
                'cad_no' => $this->request->getPost('cad_no'),
                'size_of_area' => $this->request->getPost('size_of_area'),
                'location' => $this->request->getPost('location'),
                'phase' => $this->request->getPost('phase'),
                'land_owner' => $this->request->getPost('land_owner'),
                'status' => $this->request->getPost('status'),
            ];
            $lotModel->update($lotId, $lotData);

            // Save the updated property distances
            $propertyDistanceData = [];
            $propertyDistances = $this->request->getPost('propertyDistances');
            if (!empty($propertyDistances)) {
                foreach ($propertyDistances as $distance) {
                    $propertyDistanceData[] = [
                        'id' => $distance['id'],
                        'lot_id' => $lotId,
                        'distance_to_point1' => $distance['distance_to_point1'],
                        // Add other distance fields here
                    ];
                }
                $propertyDistanceModel->updateBatch($propertyDistanceData, 'id');
            }

            // Save the updated property valuations
            $propertyValuationData = [];
            $propertyValuations = $this->request->getPost('propertyValuations');
            if (!empty($propertyValuations)) {
                foreach ($propertyValuations as $valuation) {
                    $propertyValuationData[] = [
                        'id' => $valuation['id'],
                        'lot_id' => $lotId,
                        'valuation_amount' => $valuation['valuation_amount'],
                        'tree_valuation_amount' => $valuation['tree_valuation_amount'],
                        'disturbance_amount' => $valuation['disturbance_amount'],
                        'house_structure_amount' => $valuation['house_structure_amount'],
                        // Add other valuation fields here
                    ];
                }
                $propertyValuationModel->updateBatch($propertyValuationData, 'id');
            }

            // Redirect to the lot list page or show success message
            return redirect()->to('/documents/')->with('success', 'Lot updated successfully.');
        } else {
            // Validation failed, show error messages
            $data['validation'] = $this->validator;
        }
    }

    // Load the view with data
    return view('update', $data);
}




    
    public function delete($id)
    {
        // Instantiate models
        $lotModel = new LotModel();
        $propertyDistanceModel = new PropertyDistanceModel();
        $propertyValuationModel = new PropertyValuationModel();
        $documentModel = new DocumentModel();

        // Get the lot with the provided ID from the database
        $lot = $lotModel->find($id);

        if ($lot === null) {
            // Lot not found, handle the error condition
            return redirect()->back()->with('error', 'Lot not found.');
        }

        // Delete associated records
        $propertyDistanceModel->where('lot_id', $id)->delete();
        $propertyValuationModel->where('lot_id', $id)->delete();
        $documentModel->where('lot_id', $id)->delete();

        // Perform the delete operation
        $lotModel->delete($id);

        // Redirect back to the land details page with success message
        return redirect()->to('/documents')->with('success', 'Lot deleted successfully.');
    }

    public function deleteDocument($id)
    {
        $documentModel = new DocumentModel();
        $document = $documentModel->find($id);

        if (!$document) {
            // Handle document not found error
            return redirect()->to('/documents')->with('error', 'Document not found');
        }

        $filePath = WRITEPATH . 'uploads/' . $document['file_name'];

        if (is_file($filePath) && file_exists($filePath)) {
            unlink($filePath);
            $documentModel->delete($id);

            // Redirect to the documents page with success message
            return redirect()->to('/documents')->with('success', 'Document deleted successfully');
        } else {
            // Handle file not found error
            return redirect()->to('/documents')->with('error', 'File not found');
        }
    }


    public function viewDocument($fileName)
{
    $uploadsPath = WRITEPATH . 'uploads/';

    // Get the actual file path using the original file name
    $filePath = $uploadsPath . $fileName;

    try {
        $file = new File($filePath);

        if ($file->isFile()) {
            $mime = $file->getMimeType();

            header('Content-Type: ' . $mime);
            header('Content-Disposition: inline; filename="' . $file->getOriginalName() . '"');
            header('Content-Length: ' . $file->getSize());

            readfile($filePath);
            exit();
        } else {
            // File not found, redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'File not found.');
        }
    } catch (FileNotFoundException $e) {
        // File not found, redirect back with an error message
        return redirect()->back()->withInput()->with('error', 'File not found.');
    }
}




    public function downloadDocument($documentId)
    {
        $documentModel = new DocumentModel();
        $document = $documentModel->find($documentId);

        if (!$document) {
            // Document not found, show error message or redirect back
            return redirect()->back()->with('error', 'Document not found.');
        }

        $filePath = WRITEPATH . 'uploads/' . $document['file_name'];

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }


    
}
 
