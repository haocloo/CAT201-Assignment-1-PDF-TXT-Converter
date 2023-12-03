import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.pdmodel.PDPage;

public class ConvertPDF {
    public static void main(String[] args) {
        try {
            // Create a new PDF document
            PDDocument document = new PDDocument();

            // Add a new blank page to the document
            document.addPage(new PDPage());

            // Save the document as a PDF file
            document.save("../output/test.pdf");

            // Close the document
            document.close();

            // Print a success message
            System.out.println("PDF created successfully.");
        } catch (Exception e) {
            // Print any exceptions that occur
            e.printStackTrace();
        }
    }
}
