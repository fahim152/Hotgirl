from ReadCsv import read_csv
from AnalyseData import analyse_data
from PushToPowerBi import push_to_power_bi

def main():
    file_path = 'path_to_your_csv_file.csv'
    
    # Step 1: Read data
    data = read_csv(file_path)
    
    # Step 2: Analyse data
    analysed_data = analyse_data(data)
    
    # Step 3: Push to Power BI
    response = push_to_power_bi(analysed_data)
    print(response)

if __name__ == "__main__":
    main()
